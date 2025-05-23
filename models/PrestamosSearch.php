<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prestamos;

/**
 * PrestamosSearch represents the model behind the search form of `app\models\Prestamos`.
 */
class PrestamosSearch extends Prestamos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_prestamo', 'id_usuario', 'id_libro'], 'integer'],
            [['fecha_prestamo', 'fecha_devolucion_esperada', 'fecha_devolucion_real', 'estado'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Prestamos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_prestamo' => $this->id_prestamo,
            'id_usuario' => $this->id_usuario,
            'id_libro' => $this->id_libro,
            'fecha_prestamo' => $this->fecha_prestamo,
            'fecha_devolucion_esperada' => $this->fecha_devolucion_esperada,
            'fecha_devolucion_real' => $this->fecha_devolucion_real,
        ]);

        $query->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
