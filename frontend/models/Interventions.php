<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "interventions".
 *
 * @property int $id
 * @property int $id_ticket
 * @property int $id_user
 * @property string|null $observation
 * @property string $intervention
 * @property string $date
 * @property int $duration
 *
 * @property Tickets $ticket
 * @property Users $user
 */
class Interventions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'interventions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_ticket', 'id_user', 'intervention', 'date', 'duration'], 'required'],
            [['id_ticket', 'id_user', 'duration'], 'integer'],
            [['date'], 'safe'],
            [['observation', 'intervention'], 'string', 'max' => 255],
            [['id_ticket'], 'exist', 'skipOnError' => true, 'targetClass' => Tickets::className(), 'targetAttribute' => ['id_ticket' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ticket' => 'Cod tichet',
            'id_user' => 'Cod utilizator',
            'observation' => 'Observaţii',
            'intervention' => 'Intervenţie',
            'date' => 'Dată',
            'duration' => 'Durată',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Tickets::className(), ['id' => 'id_ticket']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }
}
