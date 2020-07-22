<?php

namespace common\components;
use kriss\calendarSchedule\FullCalendarAsset;
use kriss\calendarSchedule\FullCalendarCustomAsset;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

class CalendarScheduleWidget extends \kriss\calendarSchedule\CalendarScheduleWidget
{
    /**
     * @var string
     */
    public $wrapTemplate = '<div class="row"><div class="col-md-3">{draggableEvents}{createEvents}</div><div class="col-md-9">{fullCalendar}</div></div>';

    /**
     * @var string
     */
    public $draggableEventsWrapTemplate = '<div class="panel panel-default"><div class="panel-heading">{title}</div><div class="panel-body">{items}{removeAfterDrop}{dropToTrash}</div></div>';
    /**
     * @var array
     */
    public $draggableEventOptions = [];
    /**
     * - title：标题
     * - items：
     *   - name：事件名
     *   - color：颜色
     * - canSetRemoveAfterDrop：是否可以在拖动后移除
     * - canDropToTrash：是否可以拖动到垃圾站中删除
     * - removeCallback(name, color)：在移除事件后的 js 回调函数，请使用 new JsExpression() 处理
     * @see renderDraggableEvents()
     * @var array
     */
    public $draggableEvents = [];

    /**
     * @var string
     */
    public $createEventsWrapTemplate = '<div class="panel panel-default"><div class="panel-heading">{title}</div><div class="panel-body">{colors}{addButton}</div></div>';
    /**
     * - title：标题
     * - colors：颜色值
     * - createCallback(name, color)：在点击新增完成后的 js 回调函数，请使用 new JsExpression() 处理
     * @see renderCreateEvents()
     * @var array
     */
    public $createEvents = [];

    /**
     * @var string
     */
    public $fullCalendarTemplate = '<div class="panel panel-default"><div class="panel-body">{fullCalendar}</div></div>';
    /**
     * @link https://fullcalendar.io/docs
     *
     * 常用的几个事件
     * @link https://fullcalendar.io/docs/eventReceive
     * eventReceive(event)：从事件拖到日历中放下后触发
     * @link https://fullcalendar.io/docs/eventDrop
     * eventDrop(event, delta, revertFunc, jsEvent, ui, view)：在日历中拖动事件后放下后触发
     * @link https://fullcalendar.io/docs/eventResize
     * eventResize(event, delta, revertFunc, jsEvent, ui, view)：在日历中修改了日程的长度后触发
     * @click https://fullcalendar.io/docs/eventClick
     * eventClick(event, jsEvent, view)：点击日历中的事件后触发，可以用来操作删除该事件
     *
     * 特殊处理：
     * drop 方法不可用，替换为使用 dropCallback
     *
     * 额外说明：
     * function 请使用 new JsExpression() 处理
     *
     * @var array
     */
    public $fullCalendarOptions = [];
    /**
     * 事件的默认时间间隔，不需要可以设置为 false
     * 在处理 eventReceive eventDrop 事件时如果不设置该值，则 end 为 null
     * @var string|false
     */
    public $defaultEventDuration = '02:00';
    /**
     * 日程的事件是否固定
     * 在动态调用接口时，请把此处改为false，否则会出现重复事件
     * @link https://fullcalendar.io/docs/renderEvent
     * @var bool
     */
    public $calendarEventStick = true;

    /**
     * js 实例的名称
     * 在需要使用实例方法时有用
     * @var string
     */
    public $clientJsName = 'kfc';
    /**
     * @var array
     */
    private $_clientOptions;

    public function init()
    {
        parent::init();
        $this->draggableEvents = array_merge([
            'title' => 'TITULO',
            'items' => [
                /*['name' => '洗冰箱', 'color' => '#00c0ef'],
                ['name' => '擦玻璃', 'color' => '#d81b60'],*/
            ],
            'canSetRemoveAfterDrop' => true,
            'canDropToTrash' => true,
        ], $this->draggableEvents);

        $this->createEvents = array_merge([
            'title' => 'EVENTOS',
            'colors' => ['#286090', '#5cb85c', '#5bc0de', '#f0ad4e', '#d9534f'],
        ], $this->createEvents);

        $this->fullCalendarOptions = array_merge([
            'header' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'month,agendaWeek,agendaDay',
            ],
            'themeSystem' => 'bootstrap3',
        ], $this->fullCalendarOptions);

        // 新增事件后的回调
        if (isset($this->createEvents['createCallback'])) {
            $this->_clientOptions['createEventAddNewEventCallback'] = $this->createEvents['createCallback'];
        }
        // 移除事件后的回调
        if (isset($this->draggableEvents['removeCallback'])) {
            $this->_clientOptions['draggableEventRemoveCallback'] = $this->draggableEvents['removeCallback'];
        }
        $this->_clientOptions['fullCalendarOptions'] = $this->fullCalendarOptions;
        $this->_clientOptions['defaultEventDuration'] = $this->defaultEventDuration;
        $this->_clientOptions['calendarEventStick'] = $this->calendarEventStick;
    }

    public function run()
    {
        echo strtr($this->wrapTemplate, [
            '{draggableEvents}' => $this->renderDraggableEvents(),
            '{createEvents}' => $this->renderCreateEvents(),
            '{fullCalendar}' => $this->renderFullCalendar(),
        ]);

        $this->registerAssets();
    }

    protected function registerAssets()
    {
        $view = $this->view;
        FullCalendarCustomAsset::register($view);

        $options = Json::encode($this->_clientOptions);
        $view->registerJs("var {$this->clientJsName} = new KrissCalendar({$options});");
    }

    protected function renderDraggableEvents()
    {
       

        return '';
    }

    protected function renderCreateEvents()
    {
       
        return '';
    }

    protected function renderFullCalendar()
    {
        $html = strtr($this->fullCalendarTemplate, [
            '{fullCalendar}' => '<div id="full-calendar"></div>',
        ]);

        return $html;
    }
}

