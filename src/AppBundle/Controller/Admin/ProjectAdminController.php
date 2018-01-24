<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Project;
use AppBundle\Form\ProjectFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/admin")
 */
class ProjectAdminController extends Controller
{
    /**
     * @Route("/projects", name="admin_project_list")
     */
    public function adminProjectList()
    {
        $projects = $this->getDoctrine()
            ->getRepository('AppBundle:Project')
            ->findAll();

        return $this->render('admin/project/list.html.twig', array(
            'projects' => $projects
        ));
    }





    /**
     * @Route("/projects/new", name="admin_project_new")
     */
    public function newProject(Request $request)
    {
        //$project = new Project();
        $form = $this->createForm(ProjectFormType::class);

        $form->handleRequest($request);

        //$files = $request->get('files', []);

        if($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();
            $files = $form->getData()->getFiles();
            $images = [];
            $listingImage = $form->getData()->getListingImage();
            $listingFileName = md5(uniqid()).'.jpg';
            $listingImage->move(
                $this->getParameter('image_directory'),
                $listingFileName
            );

            //dump($files);die;
            foreach($files as $file) {
                // Extension is hardcoded, will need to get it using guessExtension() http://api.symfony.com/3.4/Symfony/Component/HttpFoundation/File.html
                $fileName = md5(uniqid()).'.jpg';

                $file->move(
                    $this->getParameter('image_directory'),
                    $fileName
                );
                $images[$fileName] = $fileName;






            }

            $project->setListingImage($listingFileName);
            $project->setFiles($images);

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash('success', 'Project successfully created');
            return $this->redirectToRoute('admin_project_list');

        }

        return $this->render('admin/project/new.html.twig', [
            'projectForm' => $form->createView()
        ]);
    }






    /**
     * @Route("/projects/{id}/edit", name="admin_project_edit")
     */
    public function editProject(Request $request, Project $project)
    {
        $form = $this->createForm(ProjectFormType::class, $project);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash('success', 'Project successfully edited');
            return $this->redirectToRoute('admin_project_list');

        }

        return $this->render('admin/project/edit.html.twig', [
            'projectForm' => $form->createView()
        ]);
    }
}