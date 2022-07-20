<?php

namespace App\Traits;

use App\Models\Sensor;
use App\Models\Alert;
use App\Models\AlertSensor;
use App\Models\Threshold;

trait WithAlert
{
    public function matchesOverview()
    {
        $matches = AlertSensor::where('progressed', 0)->get();
        $count = [];

        $count['success'] = $matches->where('status_id', 1)->count();
        $count['warning'] = $matches->where('status_id', 2)->count();
        $count['error'] = $matches->where('status_id', 3)->count();
        $count['unknown'] = $matches->where('status_id', 4)->count();

        $count['sensor'] = Sensor::where('warning', 1)->count();
        $count['threshold'] = Threshold::distinct('sensor_id')->where('progressed', 0)->count();

        return $count;
    }

    public function success()
    {
        $content = [];
        $content['active'] = Alert::with('sensors')->whereHas('sensors', function($q){$q->where('status_id', 1); $q->where('progressed', 0);})->get();
        $content['progressed'] = Alert::with('sensors')->whereHas('sensors', function($q){$q->where('status_id', 1); $q->where('progressed', 1);})->get();

        return $content;
    }

    public function warning()
    {
        $content = [];
        $content['active'] = Alert::with('sensors')->whereHas('sensors', function($q){$q->where('status_id', 2); $q->where('progressed', 0);})->get();
        $content['progressed'] = Alert::with('sensors')->whereHas('sensors', function($q){$q->where('status_id', 2); $q->where('progressed', 1);})->get();

        return $content;
    }

    public function error()
    {
        $content = [];
        $content['active'] = Alert::with('sensors')->whereHas('sensors', function($q){$q->where('status_id', 3); $q->where('progressed', 0);})->get();
        $content['progressed'] = Alert::with('sensors')->whereHas('sensors', function($q){$q->where('status_id', 3); $q->where('progressed', 1);})->get();

        return $content;
    }

    public function unknown()
    {
        $content = [];
        $content['active'] = Alert::with('sensors')->whereHas('sensors', function($q){$q->where('status_id', 4); $q->where('progressed', 0);})->get();
        $content['progressed'] = Alert::with('sensors')->whereHas('sensors', function($q){$q->where('status_id', 4); $q->where('progressed', 1);})->get();

        return $content;
    }

    public function sensorWarning()
    {
        $content = Sensor::where('warning', 1)->get();

        return $content;
    }

    public function sensorThreshold()
    {
        $content['active'] = Sensor::with('thresholds')->whereHas('thresholds', function($q){$q->where('progressed', 0);})->get();
        $content['progressed'] = Sensor::with('thresholds')->whereHas('thresholds', function($q){$q->where('progressed', 1);})->get();

        return $content;
    }

    public function markAsRead($id)
    {
        $alert = Alert::find($id);
        $sensorId = $alert->sensors()->first()->id;

        $alert->sensors()->updateExistingPivot($sensorId, ['progressed' => 1], false);
    }

    public function markAsUnread($id)
    {
        $alert = Alert::find($id);
        $sensorId = $alert->sensors()->first()->id;

        $alert->sensors()->updateExistingPivot($sensorId, ['progressed' => 0], false);
    }

    public function markAllAsRead($statusId)
    {
        AlertSensor::query()->where(['status_id' => $statusId])->update(['progressed' => 1]);
    }

    public function markThresholdAsRead($id)
    {
        $threshold = Threshold::find($id);
        
        if($threshold){
            $threshold->progressed = 1;
            $threshold->save();
        }
    }

    public function markAllThresholdsAsRead()
    {
        Threshold::query()->where(['progressed' => 0])->update(['progressed' => 1]);
    }
}
