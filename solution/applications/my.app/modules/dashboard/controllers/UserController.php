<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

namespace Modules\Dashboard\Controllers;

/**
 * @RoutePrefix("/api/users")
 */
class UserController extends \Phalcon\Mvc\Controller
{

     /**
     * @Get("/{id:\d*}")
     */
    public function indexAction($id=0)
    {
        if (empty($id)) {
            echo 'all users';
        } else {
            echo 'user by id:' . $id;
        }
    }

    /**
     * @Get("/edit/{id:[0-9]+}", name="edit-robot")
     */
    public function editAction($id)
    {
        echo 'edit ' . $id;

    }

    /**
     * @Route("/save", methods={"POST", "PUT"}, name="save-robot")
     *0
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