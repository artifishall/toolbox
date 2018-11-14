<?php
namespace Artifishall\Toolbox\Traits;

trait Timers
{

    protected $timers = [];

    protected function timer($name)
    {
        if(empty($this->timers[$name]['start'])){
            $this->timers[$name]['start'] = microtime(true);
        }
    }

    protected function end_timer($name)
    {
        if(!empty($this->timers[$name])){
            $this->timers[$name]['end'] = microtime(true);
        }
    }

    public function echo_times($str = null){

        if(!empty($str)) $str .= "\n";

        foreach($this->timers as $name => $time){
            $end = empty($time['end']) ? microtime(true) : $time['end'];
            $str .= sprintf("%s : %s\n", $name, date("H:i:s", $end - $time['start']));
        }

        return $str;
    }

    public function end_echo_timer($name){
        $time = $this->timers[$name];
        $end = empty($time['end']) ? microtime(true) : $time['end'];
        $str = sprintf("%s : %s\n", $name, date("H:i:s", $end - $time['start']));
        unset($this->timers[$name]);
        return $str;
    }

    public function end_start_timer($old_name, $new_name){
        $end = $this->end_echo_timer($old_name);
        $this->timer($new_name);
        return $end;
    }

    public function timed_call($command, array $arguments = []){
        $timer_name = "$command ". implode($arguments);
        $this->timer($timer_name);
        $this->call($command, $arguments);
        $this->end_timer($timer_name);
        echo $this->echo_times();
    }


}
