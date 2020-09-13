<?php
/**
 * Created by PhpStorm.
 * User: javad
 * Date: 9/11/20
 * Time: 10:23 PM
 */

namespace App\Http\Readdata;


class Competition extends Reader
{

    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $shortName;
    /**
     * @var string
     */
    protected $image;
    /**
     * @var integer
     */
    protected $globalImportance;
    /**
     * @var string
     */
    protected $country;

    /**
     * @return array
     * this function returns the information about a competition
     */
    public function read(): array
    {
        if($this->existCompetitionInAttachment()){
            // if the information about this competition in the attachments
            $competition = $this->attachments[$this->key];
        }
        else{
            // getting the information of API
            $competition =  $this->fetchFromApi();
        }

        $this->name = $competition['name'];
        $this->shortName = $competition['shortname'];
        $this->image = $competition['image20'];
        $this->globalImportance = $competition['globalImportance'];
        $this->country = (new Country($this->api,null, $competition['country']))->read();
        return $this->buildCompetition();
    }

    /**
     * @return bool
     * this function checks if there is information about this competition in the attachments
     */
    private function existCompetitionInAttachment()
    {
        return isset($this->attachments[$this->key]) ? true : false;
    }


    /**
     *
     */
    private function fetchFromApi()
    {
        // read data from APi
        $result = $this->api->fetch($this->key);
        return $result['data'];
    }

    /**
     * @return array
     */
    private function buildCompetition(){
        return[
            'name' => $this->name,
            'shortName'=> $this->shortName,
            'image' => $this->image,
            'globalImportance' => $this->globalImportance,
            'country' => $this->country,
        ];
    }
}