<?php

namespace bussines;

class Quiz
{
    private $type;
    private $statements;
    private $result;
    public function __construct($type)
    {
        $this->type = $type;
        $this->statements = $this->get_statements();
    }

    public function get_type()
    {
        return $this->type;
    }

    public function get_statements()
    {
        if ($this->type === 'ESCALA_DEPRESION_BECK') {
            $statement_one = ['statement' => 'Tristeza', 'answers' => array('No me siento triste.', 'Me siento triste.', 'Me siento triste continuamente y no puedo dejar de estarlo.', 'Me siento tan triste o desgraciado que no puedo soportarlo.')];
            $statement_two = ['statement' => 'Pesimismo', 'answers' => array('No me siento especialmente desanimado de cara al futuro.', 'Me siento desanimado de cara al futuro.', 'Siento que no hay nada por lo que luchar.', 'El futuro es desesperanzador y las cosas no mejorarán.')];
            $statement_three = ['statement' => 'Sensación de fracaso', 'answers' => array('No me siento fracasado.', 'He fracasado más que la mayoría de las personas.', 'Cuando miro hacia atrás lo único que veo es un fracaso tras otro.', 'Soy un fracaso total como persona.')];
            $statement_four = ['statement' => 'Insatisfacción', 'answers' => array('Las cosas me satisfacen tanto como antes.', 'No disfruto de las cosas tanto como antes.', 'Ya no obtengo ninguna satisfacción de las cosas', 'Estoy insatisfecho o aburrido con respecto a todo.')];
            $statement_five = ['statement' => 'Culpa', 'answers' => array('No me siento especialmente culpable.', 'Me siento culpable en bastantes ocasiones.', 'Me siento culpable en la mayoría de las ocasiones', 'Me siento culpable constantemente.')];
            $statement_six = ['statement' => 'Expectativas de castigo', 'answers' => array('No creo que esté siendo castigado.', 'siento que quizás esté siendo castigado.', 'Espero ser castigado', 'Siento que estoy siendo castigado.')];
            $statement_seven = ['statement' => 'Autodesprecio', 'answers' => array('No estoy descontento de mí mismo.', 'Estoy descontento de mí mismo.', 'Estoy a disgusto conmigo mismo', 'Me detesto.')];
            $statement_eight = ['statement' => 'Autoacusación', 'answers' => array('No me considero peor que cualquier otro.', 'me autocritico por mi debilidad o por mis errores.', 'Estoy a disgusto conmigo mismoContinuamente me culpo por mis faltas', 'Me culpo por todo lo malo que sucede.')];
            $statement_nine = ['statement' => 'Idea suicidas', 'answers' => array('No tengo ningún pensamiento de suicidio.', 'A veces pienso en suicidarme, pero no lo haré.', 'Desearía poner fin a mi vida', 'Me suicidaría si tuviese oportunidad.')];
            $statement_ten = ['statement' => 'Episodios de llanto', 'answers' => array('No lloro más de lo normal.', 'ahora lloro más que antes.', 'Lloro continuamente', 'No puedo dejar de llorar aunque me lo proponga.')];
            $statement_eleven = ['statement' => 'Irritabilidad', 'answers' => array('No estoy especialmente irritado.', 'me molesto o irrito más fácilmente que antes.', 'me siento irritado continuamente', 'Ahora no me irritan en absoluto cosas que antes me molestaban.')];
            $statement_twelve = ['statement' => 'Retirada social', 'answers' => array('No he perdido el interés por los demás.', 'Estoy menos interesado en los demás que antes.', 'He perdido gran parte del interés por los demás', 'He perdido todo interés por los demás.')];
            $statement_thirteen = ['statement' => 'Indecisión', 'answers' => array('tomo mis propias decisiones igual que antes.', 'Evito tomar decisiones más que antes.', 'Tomar decisiones me resulta mucho más difícil que antes', 'Me es imposible tomar decisiones.')];
            $statement_fourteen = [
                'statement' => 'Cambios en la imagen corporal',
                'answers' => array(
                    'No creo tener peor aspecto que antes',
                    'Estoy preocupado porque parezco envejecido y poco atractivo.',
                    'Noto cambios constantes en mi aspecto físico que me hacen parecer poco atractivo.',
                    'Creo que tengo un aspecto horrible.',
                ),
            ];

            $statement_fifteen = [
                'statement' => 'Enlentecimiento',
                'answers' => array(
                    'Trabajo igual que antes.',
                    'Me cuesta más esfuerzo de lo habitual comenzar a hacer algo.',
                    'Tengo que obligarme a mí mismo para hacer algo.',
                    'Soy incapaz de llevar a cabo ninguna tarea.',
                ),
            ];

            $statement_sixteen = [
                'statement' => 'Insomnio',
                'answers' => array(
                    'Duermo tan bien como siempre.',
                    'No duermo tan bien como antes.',
                    'Me despierto una o dos horas antes de lo habitual y ya no puedo volver a dormirme.',
                    'Me despierto varias horas antes de lo habitual y ya no puedo volver a dormirme.',
                ),
            ];

            $statement_seventeen = [
                'statement' => 'Fatigabilidad',
                'answers' => array(
                    'No me siento más cansado de lo normal.',
                    'Me canso más que antes.',
                    'Me canso en cuanto hago cualquier cosa.',
                    'Estoy demasiado cansado para hacer nada.',
                ),
            ];

            $statement_eighteen = [
                'statement' => 'Pérdida de apetito',
                'answers' => array(
                    'Mi apetito no ha disminuido.',
                    'No tengo tan buen apetito como antes.',
                    'Ahora tengo mucho menos apetito.',
                    'He perdido completamente el apetito.',
                ),
            ];

            $statement_nineteen = [
                'statement' => 'Pérdida de peso',
                'answers' => array(
                    'No he perdido peso últimamente.',
                    'He perdido más de 2 kilos.',
                    'He perdido más de 4 kilos.',
                    'He perdido más de 7 kilos.',
                ),
            ];

            $statement_twenty = [
                'statement' => 'Preocupaciones somáticas',
                'answers' => array(
                    'No estoy preocupado por mi salud',
                    'Me preocupan los problemas físicos como dolores, malestar de estómago, catarros, etc.',
                    'Me preocupan las enfermedades y me resulta difícil pensar en otras cosas.',
                    'Estoy tan preocupado por las enfermedades que soy incapaz de pensar en otras cosas.',
                ),
            ];

            $statement_twentyone = [
                'statement' => 'Bajo nivel de energía',
                'answers' => array(
                    'No he observado ningún cambio en mi interés por el sexo.',
                    'La relación sexual me atrae menos que antes.',
                    'Estoy mucho menos interesado por el sexo que antes.',
                    'He perdido totalmente el interés sexual.',
                ),
            ];


            $statements = array($statement_one, $statement_two, $statement_three, $statement_four, $statement_five, $statement_six, $statement_seven, $statement_eight, $statement_nine, $statement_ten, $statement_eleven, $statement_twelve, $statement_thirteen, $statement_fourteen, $statement_fifteen, $statement_sixteen, $statement_seventeen, $statement_eighteen, $statement_nineteen, $statement_twenty, $statement_twentyone);

            return $statements;
        } 
        if($this->type === 'ANSIEDAD_DE_BURNS') {
            $statement_one = [
                'statement' => 'Ansiedad, nerviosismo, preocupaciones o miedo',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SENSACIONES DE CARÁCTER ANSIOSO',
            ];

            $statement_two = [
                'statement' => 'Sensación de que las cosas de tu alrededor son extrañas o irreales',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SENSACIONES DE CARÁCTER ANSIOSO',
            ];

            $statement_three = [
                'statement' => 'Sensación de distanciamiento respecto de todo o alguna parte de tu cuerpo',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SENSACIONES DE CARÁCTER ANSIOSO',
            ];

            $statement_four = [
                'statement' => 'Crisis repentinas, inesperadas, de angustia',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SENSACIONES DE CARÁCTER ANSIOSO',
            ];

            $statement_five = [
                'statement' => 'Temor o sensación de muerte inminente',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SENSACIONES DE CARÁCTER ANSIOSO',
            ];

            $statement_six = [
                'statement' => 'Sensación de estar tenso, estresado o «al límite»',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SENSACIONES DE CARÁCTER ANSIOSO',
            ];

            $statement_seven = [
                'statement' => 'Dificultad para concentrarte',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];

            $statement_eight = [
                'statement' => 'Incapacidad para centrarte en un pensamiento. Fugacidad de ideas',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];

            $statement_nine = [
                'statement' => 'Pensamientos atemorizantes',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];

            $statement_ten = [
                'statement' => 'Sentir que te encuentras a punto de perder el control',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];

            $statement_eleven = [
                'statement' => 'Miedo a sufrir un colapso o a volverte loco/a',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];

            $statement_twelve = [
                'statement' => 'Temor a sufrir un desmayo o a perder la conciencia',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];

            $statement_thirteen = [
                'statement' => 'Miedo a padecer una enfermedad física o a sufrir un ataque al corazón',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];

            $statement_fourteen = [
                'statement' => 'Preocupación por parecer tonto o incompetente delante de otras personas',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];

            $statement_fifteen = [
                'statement' => 'Miedo a estar solo/a, aislado/a de los demás, o a ser abandonado/a',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];

            $statement_sixteen = [
                'statement' => 'Temor a la crítica o a la desaprobación',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];

            $statement_seventeen = [
                'statement' => 'Sensación de que algo terrible va a ocurrir',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'PENSAMIENTOS DE CARÁCTER ANSIOSO',
            ];
            
            $statement_eighteen = [
                'statement' => 'Su corazón se acelera, late fuertemente y le sacude el pecho (denominado, también “palpitaciones”)',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_nineteen = [
                'statement' => 'Dolor, opresión o tensión en el pecho',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_twenty = [
                'statement' => 'Sensación de hormigueo o entumecimiento en los dedos de las manos y de los pies',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_twenty_one = [
                'statement' => 'Sensación de nervios o malestar abdominal',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_twenty_two = [
                'statement' => 'Estreñimiento o diarrea',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_twenty_three = [
                'statement' => 'Inquietud y sobresaltos',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_twenty_four = [
                'statement' => 'Tensión y agarrotamiento muscular',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_twenty_five = [
                'statement' => 'Sudoración independiente del calor',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_twenty_six = [
                'statement' => 'Sensación de tener un nudo en la garganta',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_twenty_seven = [
                'statement' => 'Temblores o sacudidas',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_twenty_eight = [
                'statement' => 'Piernas temblorosas o flojera',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];

            $statement_twenty_nine = [
                'statement' => 'Sensación de mareo, aturdimiento o pérdida de equilibrio',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_thirty = [
                'statement' => 'Sensación de ahogo o de falta de aliento o dificultades respiratorias',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_thirty_one = [
                'statement' => 'Dolores de cabeza, de cuello o de espalda',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_thirty_two = [
                'statement' => 'Sofocaciones o escalofríos',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];
            
            $statement_thirty_three = [
                'statement' => 'Sensación de sueño, debilidad y agotamiento',
                'answers' => array(
                    'Nada',
                    'Algo',
                    'Bastante',
                    'Mucho',
                ),
                'category' => 'SÍNTOMAS FÍSICOS',
            ];

            
            $statements = array(
                $statement_one,
                $statement_two,
                $statement_three,
                $statement_four,
                $statement_five,
                $statement_six,
                $statement_seven,
                $statement_eight,
                $statement_nine,
                $statement_ten,
                $statement_eleven,
                $statement_twelve,
                $statement_thirteen,
                $statement_fourteen,
                $statement_fifteen,
                $statement_sixteen,
                $statement_seventeen,
                $statement_eighteen,
                $statement_nineteen,
                $statement_twenty,
                $statement_twenty_one,
                $statement_twenty_two,
                $statement_twenty_three,
                $statement_twenty_four,
                $statement_twenty_five,
                $statement_twenty_six,
                $statement_twenty_seven,
                $statement_twenty_eight,
                $statement_twenty_nine,
                $statement_thirty,
                $statement_thirty_one,
                $statement_thirty_two,
                $statement_thirty_three,
            );
            
            return $statements;
        }
    }
}
