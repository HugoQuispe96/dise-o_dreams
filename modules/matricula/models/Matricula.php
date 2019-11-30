<?php

namespace app\modules\matricula\models;
use app\modules\pago\models\Solicitud;

use Yii;

/**
 * This is the model class for table "matricula".
 *
 * @property int $id
 * @property int $id_solicitud
 * @property string $estado
 * @property string $fecha_vencimiento
 *
 * @property SolicitudPago $solicitud
 */
class Matricula extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'matricula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_solicitud', 'estado', 'fecha_vencimiento'], 'required'],
            [['id_solicitud'], 'integer'],
            [['fecha_vencimiento'], 'safe'],
            [['estado'], 'string', 'max' => 45],
            [['id_solicitud'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitud::className(), 'targetAttribute' => ['id_solicitud' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_solicitud' => 'Id Solicitud',
            'estado' => 'Estado',
            'fecha_vencimiento' => 'Fecha Vencimiento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitud()
    {
        return $this->hasOne(Solicitud::className(), ['id' => 'id_solicitud']);
    }
}
