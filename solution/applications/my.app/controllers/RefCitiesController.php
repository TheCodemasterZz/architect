<?php

/**
 * architect - a PHP Framework for rapid developing
 *
 * @package  architect
 * @author   Baris Kalaycioglu <thecodemasterzz@gmail.com>
 */

/**
 * @RoutePrefix("/api/ref/cities")
 */
class RefCitiesController extends \Phalcon\Mvc\Controller
{

     /**
     * @Get("/{id:\d*}")
     */
    public function indexAction($id=0)
    {

        $query = null;
        if ( $id !== "" ) {
            $quest = array(
                "id = '{$id}'"
            );
        }

        $cities = RefCities::find($query);

        if ($cities == false) {
            $this->response->setJsonContent(array(
                'status' => 'NOT-FOUND')
            );

            return $this->response;
        }  

        if ( $id !== "" ) {
            $data = $cities->getFirst();
        } else {
            $data = array();
            foreach ($cities as $city) {
                $data[] = $city;
            }
        }
    
        $this->response->setJsonContent(array(
            'status' => 'FOUND',
            'data' => $data
        ));

        return $this->response;
    }
}