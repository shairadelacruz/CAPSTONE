<?php

namespace App;

use ReflectionClass;

trait RecordsActivity

{
	public static function bootRecordsActivity()
    {

        foreach (static::getModelEvents() as $event) {
        	
        	static::$event(function($model) use($event) {

	            $model->recordActivity($event);
        	});
        }

    }

    public function recordActivity($event)
    {
    	Activity::create([

	       	'subject_id' => $this->id,
	        'subject_type' => get_class($this),
	        'name' => $this->getActivityName($this, $event),
	        'user_id' => \Auth::id()
	    ]);
    }

    protected function getActivityName($model, $action)
    {
    	$name = strtolower((new ReflectionClass($model))->getShortName());

    	return "{$action}_{$name}";

    }

    protected static function getModelEvents()
    {
    	if(isset(static::$recordEvents)){

    		return static::$recordEvents;
    	}

    	return [
    		'created', 'deleted', 'updated'
    	];

    }

}