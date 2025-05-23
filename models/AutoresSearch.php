<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Autores;

/**
 * AutoresSearch represents the model behind the search form of `app\models\Autores`.
 */
class AutoresSearch extends Autores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_autor'], 'integer'],
            [['nombre', 'apellido', 'biografia', 'fecha_nacimiento', 'fecha_fallecimiento', 'nacionalidad'], 'safe'],
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
        $query = Autores::find();

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
            'id_autor' => $this->id_autor,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'fecha_fallecimiento' => $this->fecha_fallecimiento,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'biografia', $this->biografia])
            ->andFilterWhere(['like', 'nacionalidad', $this->nacionalidad]);

        return $dataProvider;
    }
}
