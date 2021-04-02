<?php

namespace AppBundle\Command;

use DateTime;
use Pimcore\Mail;
use Pimcore\Console\AbstractCommand;
use Pimcore\Console\Dumper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;


class AwesomeCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('awesome:command')
            ->setDescription('Awesome command')
            ->addOption("file","f", InputOption::VALUE_REQUIRED,"Pass file path"); 

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // dump
        $this->dump("Isn't that awesome?");

        // add newlines through flags
        $this->dump("Dump #2", Dumper::NEWLINE_BEFORE | Dumper::NEWLINE_AFTER);

        // only dump in verbose mode
        $this->dumpVerbose("Dump verbose", Dumper::NEWLINE_BEFORE);
        
        // Output as white text on red background.
        $this->writeError('oh noes!');
        //p_r($input->getOptions()['file']);

        //$obj = new \Pimcore\Model\DataObject\SampleClass();
        //$obj->setKey('FirstObject3');
        //$obj->setParentId(11);
        //$obj->setSimpleInput($input->getOptions()["file"]);
        //$obj->setPublished(true);
        //$unit = DataObject\QuantityValue\Unit::getByAbbreviation("kmpl");
        //$obj->setSimpleQuantity(new DataObject\Data\QuantityValue(44, $unit->getId()));
        //$obj->save();
        //$productData = json_decode($input->getOptions()["file"]);

        $dataFileName = $input->getOptions()["file"];
        //$filepath = (PIMCORE_PROJECT_ROOT . '/web/var/assets/'.$dataFileName);
        $filepath = (PIMCORE_PROJECT_ROOT .'/'.$dataFileName);
        $jsonFile = file_get_contents($filepath);

        //p_r($filepath);
        //p_r($jsonFile);
        $productData = json_decode($jsonFile);


        //p_r($productData);die;
        
        foreach ($productData as $prodItem)
        {
            $obj = new \Pimcore\Model\DataObject\SampleClass();
            $unit=$prodItem->my_unit;
            $key=$prodItem->my_key_value;
            $p_id=$prodItem->my_parent_id;
            $simp_in=$prodItem->my_simple_input;
            $pub=$prodItem->my_published_value;
            $quant_val=$prodItem->my_quantity_value;
            $mdate_time=$prodItem->my_date_time;
            $mdate = $prodItem->my_date;


            // converting the datetime string received to the timestamp so that it can be passed to setSampleDateTime() 
            // which inturns call getTimestamp()

            //$dateTimeTimestamp = strtotime($mdate);

            $ndateTime = new DateTime($mdate_time);

            $ndate = new DateTime($mdate);
            


            $obj->setKey($key);
            $obj->setParentId($p_id);
            $obj->setSimpleInput($simp_in);
            $obj->setPublished($pub);
            $unit_sign = DataObject\QuantityValue\Unit::getByAbbreviation($unit);
            $obj->setSimpleQuantity(new DataObject\Data\QuantityValue($quant_val, $unit_sign->getId()));
            //$obj->setSampleDateTime($dateTimeTimestamp);
            $obj->setSampleDateTime($ndateTime);
            $obj->setSampleDate($ndate);
            $obj->save();

        }

        $mail = new \Pimcore\Mail();
        $mail->addTo('raghavrastogi09@gmail.com');
        $mail->setSubject("checking the working of Pimcore\Mailer");
        $mail->send();

    }
}