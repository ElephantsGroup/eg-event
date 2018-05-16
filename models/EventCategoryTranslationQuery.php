<?php

namespace elephantsGroup\event\models;

/**
 * This is the ActiveQuery class for [[EventCategoryTranslation]].
 *
 * @see EventCategoryTranslation
 */
class EventCategoryTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return EventCategoryTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EventCategoryTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
