<?php
class Tree extends AppendIterator implements RecursiveIterator, Countable
{
    protected $tree;
    protected $key;

    protected $total;

    public function __construct($tree = [])
    {
        $this->tree = array_values($tree);
        $this->key = 0;

        $this->total = count($this->tree);
    }

    public function current()
    {
        return $this->tree[$this->key];
    }

    public function getChildren()
    {
        return new Tree($this->tree[$this->key]['children']);
    }

    public function hasChildren()
    {
        return isset($this->tree[$this->key]['children']) && $this->tree[$this->key]['children'];
    }

    public function key()
    {
        return $this->key;
    }

    public function next()
    {
        $this->key++;
    }

    public function rewind()
    {
        $this->key = 0;
    }

    public function valid()
    {
        return isset($this->tree[$this->key]);
    }

    public function append(Tree $tree)
    {
        $this->tree[] = $tree;
        $this->total++;

        return $this->tree;
    }

    public function appendChild(Tree $tree)
    {
        if ($this->hasChildren()) {
            $this->tree[$this->key]['children'][] = $tree;
        } else {
            $this->tree[$this->key]['children'] = [$tree];
        }
    }

    public function count()
    {
        return $this->total;
    }
}
