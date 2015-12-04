<?php

/**
* architect - a PHP Framework for rapid developing
*
* @package  architect
* @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
*/

use \Phalcon\Mvc\Controller;

/**
 * @RoutePrefix("/api/products")
 */
class ProductsController extends Controller
{
    /**
     * @Post("/")
     */
    public function indexAction()
    {

    }

    /**
     * @Get("/edit/{id:[0-9]+}", name="edit-robot")
     */
    public function editAction($id)
    {

    }

    /**
     * @Route("/save", methods={"POST", "PUT"}, name="save-robot")
     */
    public function saveAction()
    {

    }

    /**
     * @Route("/delete/{id:[0-9]+}", methods="DELETE",
     *      conversors={id="MyConversors::checkId"})
     */
    public function deleteAction($id)
    {

    }

    public function infoAction($id)
    {

    }
}