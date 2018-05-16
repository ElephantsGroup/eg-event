<?php

namespace elephantsGroup\event\models;

/**
 * This is the ActiveQuery class for [[EventTranslation]].
 *
 * @see EventTranslation
 */
class EventTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return EventTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EventTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
