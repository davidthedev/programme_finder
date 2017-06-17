<?php

namespace App\Models;

use App\Contracts\ProtectorInterface as ProtectorInterface;

class Search
{
    private $protector;
    private $dataSource;
    private $imgUrl;
    private $searchTerm;

    /**
     * Set protector (for data cleaning)
     *
     * @param object $protector
     */
    public function __construct(ProtectorInterface $protector)
    {
        $this->protector = $protector;
    }

    /**
     * Set data source
     *
     * @param string $dataSource
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = trim($dataSource);
    }

    /**
     * Get data source
     *
     * @return string
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * Set img URL
     *
     * @param string
     */
    public function setImgUrl($url)
    {
        $this->imgUrl = $url;
    }

    /**
     * Get img url
     *
     * @return string
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * Set search term
     *
     * @param string $searchTerm
     */
    public function setSearchTerm($searchTerm)
    {
        $this->searchTerm = trim($searchTerm);
    }

    public function getSearchTerm()
    {
        return $this->searchTerm;
    }

    /**
     * Read the data source file into a string and decode a JSON string
     *
     * @return object
     */
    private function readAndDecodeJson()
    {
        $data = file_get_contents($this->dataSource);
        return json_decode($data);
    }


    /**
     * Get results
     *
     * @return array
     */
    public function getResults()
    {
        $results = array();

        $titles = $this->readAndDecodeJson();
        $titles = $titles->atoz->tleo_titles;

        if (!$this->searchTerm) {
            return array();
        }

        foreach ($titles as $title) {
            $result = array();

            if (stripos($title->programme->title, $this->searchTerm) !== false) {
                $result['title'] = $this->protector->escape($title->programme->title);
                $result['short_synopsis'] = $this->protector->escape($title->programme->short_synopsis);
                $result['img_url'] =  $this->imgUrl . $this->protector->escape($title->programme->image->pid) . '.jpg';
            }

            if ($result) {
                $results[] = $result;
            }
        }

        sort($results, SORT_REGULAR);

        return $results;
    }
}
