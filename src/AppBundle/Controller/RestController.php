<?php

namespace AppBundle\Controller;

use Pimcore;
use Pimcore\Bundle\AdminBundle\Controller\Rest\AbstractRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\component\HttpFoundation\JsonResponse;

/**
 * Class RestController
 * @package AppBundle\Controller
 */
class RestController extends Pimcore\Bundle\AdminBundle\Controller\Rest\AbstractRestController
{
    /**
     * @Route("/webservice/brandlist", methods={"GET"})
     */
    public function getBrand(Request $request)
    {
        //$this->checkPermission('objects');
        //Products listing
        $brands = new Pimcore\Model\DataObject\Brand\Listing();
        foreach ($brands as $key => $brand) {
            $data[] = array(
                "brand_name" => $brand->getBrandName(),
                "brand_description" => $brand->getBrandDescription(),
                //"id" => $brand->getBrandID()
            );
        }

        return $this->adminJson(["success" => true, "data" => $data]);
    }
   }