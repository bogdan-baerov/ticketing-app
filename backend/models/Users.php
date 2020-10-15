<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $account
 * @property string $department
 * @property string $location
 * @property int $status
 *
 * @property Interventions[] $interventions
 * @property Tickets[] $tickets
 * @property Tickets[] $tickets0
 */
class Users extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    public function init()
    {
        parent::init();
        //setting up default values
        $this->status = self::STATUS_ACTIVE;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required',  'message' => 'Vă rugăm să introduceți numele complet!'],
            [['account'], 'required',  'message' => 'Vă rugăm să introduceți numele de utilizator!'],
            [['department'], 'required',  'message' => 'Vă rugăm să introduceți departamentul corespunzător!'],
            [['location'], 'required',  'message' => 'Vă rugăm să introduceți locația corespunzătoare!'],


            [['status'], 'required'],
            [['status'], 'integer'],
            [['name', 'account'], 'string', 'max' => 30],
            [['department'], 'string', 'max' => 127],
            [['location'], 'string', 'max' => 10],
            [['account'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nume',
            'account' => 'Utilizator',
            'department' => 'Departament',
            'location' => 'Locație',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterventions()
    {
        return $this->hasMany(Interventions::className(), ['id_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['id_it_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets0()
    {
        return $this->hasMany(Tickets::className(), ['id_user' => 'id']);
    }
}
