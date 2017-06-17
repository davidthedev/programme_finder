<?php

use PHPUnit\Framework\TestCase;

use App\Models\Search;
use App\Services\Protector;

class SearchTest extends TestCase
{
    private $protector;
    private $search;
    private $dataSource;
    private $imgUrl;

    public function setUp()
    {
        $this->protector = new Protector;
        $this->search = new Search($this->protector);
        $this->dataSource = 'https://rmp.files.bbci.co.uk/technical-test/source-data.json';
        $this->imgUrl = 'https://ichef.bbci.co.uk/images/ic/480x270/';
    }

    public function testDataSourceIsSet()
    {
        $this->search->setDataSource($this->dataSource);
        $this->assertEquals($this->search->getDataSource(), $this->dataSource);
    }

    public function testImgUrlsIsSet()
    {
        $this->search->setImgUrl($this->imgUrl);
        $this->assertEquals($this->search->getImgUrl(), $this->imgUrl);
    }

    public function testSearchTermIsSet()
    {
        $searchTerm = 'Archers';
        $this->search->setSearchTerm($searchTerm);
        $this->assertEquals($this->search->getSearchTerm(), $searchTerm);
    }

    public function testGetsResults()
    {
        $this->search->setDataSource($this->dataSource);
        $this->search->setImgUrl($this->imgUrl);

        $searchTerm = 'archers';
        $this->search->setSearchTerm($searchTerm);

        $equals = array(
            '0' => array(
                'title'             => 'The Archers',
                'short_synopsis'    => 'Contemporary drama in a rural setting',
                'img_url'           => 'https://ichef.bbci.co.uk/images/ic/480x270/p04jkb89.jpg'
            ),
            '1' => array(
                'title'             => 'The Archers Omnibus',
                'short_synopsis'    => 'The week\'s events in Ambridge',
                'img_url'           => 'https://ichef.bbci.co.uk/images/ic/480x270/p04jqv00.jpg'
            )
        );

        $this->assertEquals($this->search->getResults(), $equals);
    }

    public function testGetsResultsIfNoTitlesFound()
    {
        $this->search->setDataSource($this->dataSource);
        $this->search->setImgUrl($this->imgUrl);

        $searchTerm = 'not real';
        $this->search->setSearchTerm($searchTerm);

        $this->assertEquals($this->search->getResults(), array());
    }
}
