<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{

    /**
     * @Route("/info/{id}",name="information")
     */
   public function renderInfo(Request $request,$id)
       {//$parameters = $request->query->add(["Favourite sport"=>"Cricket","Color"=>"blue"]);
        //$parameters = $request->query->keys();
        //$request = str_replace("=","=>",$request);
        //$parameters = $request;
        //$parameters = explode("&",$request);
          $parameters = $request->query->all();
          return $this->render("BaseController/BaseController.html.twig", ['parameters'=>$parameters,'id'=>$id]);
        // return new Response("<html>haha</html>");
    }
}
