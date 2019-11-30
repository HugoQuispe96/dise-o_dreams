<?php

namespace app\modules\pago\models;

use Yii;

/**
 * This is the model class for table "boleta".
 *
 * @property int $id
 * @property string $fecha
 * @property int $valor
 *
 * @property SolicitudPago[] $solicitudPagos
 */
class Boleta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'boleta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'valor'], 'required'],
            [['fecha'], 'safe'],
            [['valor'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'valor' => 'Valor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudPagos()
    {
        return $this->hasMany(SolicitudPago::className(), ['boleta_idboleta' => 'id']);
    }
}
