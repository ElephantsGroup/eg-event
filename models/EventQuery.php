<?php

namespace elephantsGroup\event\models;

/**
 * This is the ActiveQuery class for [[Event]].
 *
 * @see Event
 */
class EventQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Event[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Event|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
	
	public function confirmed()
    {
        return $this->andWhere(['status' => Event::$_STATUS_CONFIRMED]);
    }
	
	public function archived()
    {
        return $this->andWhere(['status' => Event::$_STATUS_ARCHIVED]);
    }
}
