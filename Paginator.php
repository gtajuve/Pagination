<?php


class Paginator
{
    private $page;
    private $limit;
    private $total;

    public function create($numLinks)
    {
        if($this->limit=='all'){
            return '';
        }
        $last=ceil($this->total/$this->limit);
        $start=($this->page-$numLinks>0)?$this->page-$numLinks:1;
        $last=(($this->page+$numLinks)<$last)?$this->page+$numLinks:$last;
        $html='<ul class="pagination">';
        $style=($this->page==1)?'display:none':'';
        $html.='<li  style="'.$style.'"><a href="?page='.($this->page-1).'&perPage='.$this->limit.'">Prev</a></li>';
        for($i=$start;$i<=$last;$i++){
            $html.='<li ><a href="?page='.$i.'&perPage='.$this->limit.'">'.$i.'</a></li>';
        }
        $style=($this->page==$last)?'display:none':'';
        $html.='<li  style="'.$style.'"><a href="?page='.$last.'&perPage='.$this->limit.'">Last</a></li>';
        $html.='<li ><a href="?perPage=all">All</a></li>';
        $html.='</ul>';
        return $html;

    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

}