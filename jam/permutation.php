class Permutations implements Iterator
{
    protected $c = null;
    protected $s = null;
    protected $n = 0;
    protected $pos = 0;

    function __construct($s) {
        if(is_array($s)) {
            $this->s = array_values($s);
            $this->n = count($this->s);
        } else {
            $this->s = (string) $s;
            $this->n = strlen($this->s);
        }
        $this->rewind();
    }
    function key() {
        return $this->pos;
    }
    function current() {
        $r = array();
        foreach($this->c as $k)
            $r[] = $this->s[$k];
        return is_array($this->s) ? $r : implode('', $r);
    }
    function next() {
        if($this->_next())
            $this->pos++;
        else
            $this->pos = -1;
    }
    function rewind() {
        $this->c = range(0, $this->n - 1);
        $this->pos = 0;
    }
    function valid() {
        return $this->pos >= 0;
    }
    //
    protected function _next() {
        $n = count($this->c);
        if($n == 1) return false;
        for($i = $n - 2; $this->c[$i] > $this->c[$i + 1]; $i--)
            if(!$i) return false;
        for($j = $n - 1; $this->c[$i] > $this->c[$j]; $j--);
        $q = $this->c[$j];
        $this->c[$j] = $this->c[$i];
        $this->c[$i] = $q;
        while(++$i < --$n) {
            $q = $this->c[$n];
            $this->c[$n] = $this->c[$i];
            $this->c[$i] = $q;
        }
        return true;
    }
}
