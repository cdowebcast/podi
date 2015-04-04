<?php
/**
 *
 */
class Podcast implements Iterator {

    private $currentIndex;



    public  function __construct(){
        $this->currentIndex = 0;
    }
    public function add($title, $link, $description,$enclosure_url,$guid,$author){
        //TODO: Implement add() method.
    }
    public function delete($itemId){
        //TODO: Implement delete() method.
    }
    public function update($title, $link, $description,$enclosure_url,$guid,$author,$itemId){
        // TODO: Implement update() method.
    }
    public function renderItemsInRange($index, $offset){
        // TODO: Implement renderItemsInRange() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current(){
        $outPut = $this->getItemOfFeed($this->currentIndex);
        return $outPut;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next(){
        ++$this->currentIndex;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key(){
        // TODO: Implement key() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid(){
        // TODO: Implement valid() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind(){
        $this->currentIndex = 0;
    }
}