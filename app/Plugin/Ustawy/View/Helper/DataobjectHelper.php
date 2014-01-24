<?php

class DataobjectHelper extends AppHelper
{
    /**
     * @var array
     */
    protected $object;
    /**
     * @var View
     */
    protected $view;

    public function setObject(View $view, $object = array())
    {
        $this->object = $object;
        $this->view = $view;
    }

    public function getDate($field_pattern = 'data', $add_hour = false)
    {
        foreach (array_keys($this->getData()) as $key) {
            if (preg_match("/$field_pattern/", $key)) {
                $formatting = array(
                    'day' => date('d', strtotime($this->getData($key))),
                    'year' => date('Y', strtotime($this->getData($key))),
                    'month' => __(date('M', strtotime($this->getData($key))), true),
                    'hour' => (date('H:i', strtotime($this->getData($key))) == '00:00' || !$add_hour) ? ' ' : date('H:i', strtotime($this->getData($key))),
                );
                $temp = '<span>{day}</span>
                <p>{month} {year}</p>
                <div class="times">{hour}</div>';
                foreach ($formatting as $key => $partial) {
                    $temp = preg_replace('/\{' . $key . '\}/', $partial, $temp);
                }
                return $temp;

            }
        }
        return false;
    }

    public function getData($key = null)
    {
        if (is_null($key)) {
            return $this->object['data'];
        } else {
            if (isset($this->object['data'][$key])) {
                return $this->object['data'][$key];
            } else {
                return false;
            }
        }
    }

    public function render($theme = 'default')
    {
        return $this->view->element($theme, array('item' => $this->object, 'theme' => $theme, 'file' => $this->object['dataset']), array('plugin' => 'Ustawy'));
    }

} 