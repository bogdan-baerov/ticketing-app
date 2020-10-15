<?php

namespace frontend\models;

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
 * @property Users $itUser
 * @property Users $user
 */
class Tickets extends \yii\db\ActiveRecord
{
    public function init()
    {
        parent::init();
        //setting up default values
        $this->date = date('yy-m-d');
        $this->status = 'Creat';

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
             $user_ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
             //ip pass from proxy
            $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }

        $this->ip_address = $user_ip;
    }
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
            [['id_user'], 'required',  'message' => 'Vă rugăm să selectați un nume de utilizator!'],
            [['priority'], 'required',  'message' => 'Vă rugăm să selectați nivelul priorității tichetului!'],
            [['location'], 'required',  'message' => 'Vă rugăm să scrieți locația dumneavoastră!(corp, etaj, cameră)'],
            [['problem'], 'required',  'message' => 'Vă rugăm să scrieți sumar problema!'],
            [['ip_address', 'date', 'status'], 'required'],
            [['id_user', 'id_it_user'], 'integer'],
            [['date'], 'safe'],
            [['ip_address'], 'string', 'max' => 15],
            [['priority', 'location', 'status'], 'string', 'max' => 10],
            [['problem'], 'string', 'max' => 255],
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
            'id_user' => 'Cod utilizator',
            'ip_address' => 'Adresă IP',
            'priority' => 'Prioritate',
            'location' => 'Locaţie',
            'problem' => 'Problemă',
            'date' => 'Dată',
            'status' => 'Status',
            'id_it_user' => 'Cod utilizator IT',
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
}
