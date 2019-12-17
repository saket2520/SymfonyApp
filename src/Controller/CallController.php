<?php
namespace App\Controller;
//use App\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class CallController extends AbstractController
{
    /**
     * @Route("/send",name="send")
     */
    public function sendInfo()
    {
      return $this->redirectToRoute("information",['id'=>7,'name'=>'Saket',"Email_id"=>23,"Employee_id"=>304358,"Subject"=>"Symfony",
          "Designation"=>"SoftwareDeveloper","Address"=>"Hyderabad","CompanyName"=>"Valuelabs","College"=>"Kiet",
          "Branch"=>"Computer Science","Technology"=>"ReactJS","HR"=> "Megha Mayuri",]);
    }
}
