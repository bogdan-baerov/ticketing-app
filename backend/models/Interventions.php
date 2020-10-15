<?php

namespace backend\models;

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
 * @property Appusers $user
 */
class Interventions extends \yii\db\ActiveRecord
{

    public function init()
    {
        parent::init();
        //setting up default values
        $this->date = date('Y-m-d');
        $this->id_user = (int)\Yii::$app->request->get('id_user');
        $this->id_ticket = (int)\Yii::$app->request->get('id_ticket');
    }
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
            [['intervention'] , 'required',  'message' => 'Vă rugăm să introduceți intervenția!'],
            [['duration'] , 'required',  'message' => 'Vă rugăm să introduceți durata!'],
            [['id_ticket', 'id_user', 'intervention', 'date', 'duration'], 'required'],
            [['id_ticket', 'id_user', 'duration'], 'integer'],
            [['date'], 'safe'],
            [['observation', 'intervention'], 'string', 'max' => 255],
            [['id_ticket'], 'exist', 'skipOnError' => true, 'targetClass' => Tickets::className(), 'targetAttribute' => ['id_ticket' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Appusers::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ticket' => 'Id Ticket',
            'id_user' => 'Id User',
            'observation' => 'Observații',
            'intervention' => 'Intervenția',
            'date' => 'Data',
            'duration' => 'Durata',
        ];
    }

    /**
     * Gets query for [[Ticket]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Tickets::className(), ['id' => 'id_ticket']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Appusers::className(), ['id' => 'id_user']);
    }
}
