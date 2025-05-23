<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Libros;

/**
 * LibrosSearch represents the model behind the search form of `app\models\Libros`.
 */
class LibrosSearch extends Libros
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_libro', 'id_autor', 'id_categoria', 'id_editorial', 'paginas', 'disponible'], 'integer'],
            [['titulo', 'isbn', 'anio_publicacion', 'sinopsis', 'portada', 'archivo_pdf', 'fecha_agregado'], 'safe'],
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
        $query = Libros::find();

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
            'id_libro' => $this->id_libro,
            'id_autor' => $this->id_autor,
            'id_categoria' => $this->id_categoria,
            'id_editorial' => $this->id_editorial,
            'anio_publicacion' => $this->anio_publicacion,
            'paginas' => $this->paginas,
            'fecha_agregado' => $this->fecha_agregado,
            'disponible' => $this->disponible,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'isbn', $this->isbn])
            ->andFilterWhere(['like', 'sinopsis', $this->sinopsis])
            ->andFilterWhere(['like', 'portada', $this->portada])
            ->andFilterWhere(['like', 'archivo_pdf', $this->archivo_pdf]);

        return $dataProvider;
    }
}
