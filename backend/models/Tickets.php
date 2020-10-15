<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property int $id_user
 * @property string $ip_address
 * @property string $priority
 * @property string $location
 * @property string $problem
 * @property string $date
 * @property string $status
 * @property int|null $id_it_user
 *
 * @property Interventions[] $interventions
 * @property Appusers $itUser
 * @property Users $user
 
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'ip_address', 'priority', 'location', 'problem', 'date', 'status'], 'required'],
            [['id_user', 'id_it_user'], 'integer'],
            [['date'], 'safe'],
            [['ip_address'], 'string', 'max' => 15],
            [['priority', 'location', 'status'], 'string', 'max' => 10],
            [['problem'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_it_user'], 'exist', 'skipOnError' => true, 'targetClass' => Appusers::className(), 'targetAttribute' => ['id_it_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Utilizator',
            'ip_address' => 'Adresă IP',
            'priority' => 'Prioritate',
            'location' => 'Locație',
            'problem' => 'Problemă',
            'date' => 'Dată',
            'status' => 'Status',
            'id_it_user' => 'Utilizator IT',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterventions()
    {
        return $this->hasMany(Interventions::className(), ['id_ticket' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }

    /**
     * Gets query for [[ItUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItUser()
    {
        return $this->hasOne(Appusers::className(), ['id' => 'id_it_user']);
    }

}
