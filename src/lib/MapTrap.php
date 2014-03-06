<?php

class MapTrap
{
  private $_callback = null;

  function setCallback($callback)
  {
    if (!is_callable($callback)) {
      throw new Exception('$callback is not callable');
    }
    $this->_callback = $callback;
  }

  function __invoke($ar, $trap)
  {
    $callback = $this->_callback;
    if ($callback == null) {
      throw new Exception('$callback is null');
    }

    $results = array();
    $trapped = false;
    foreach ($ar as $vv) {
      if ($trapped) {
        $results[] = $trap;
        continue;
      }
      $result = $callback($vv);
      $results[] = $result;
      if ($result == $trap) {
        $trapped = true;
      }
    }
    return $results;
  }
}