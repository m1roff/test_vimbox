<?php

class Answers
{
    public function getResponse(array $answers)
    {
        // Проверки на корректный ввод данных $answers
        if ($answers) {
            $responseData = [];
            foreach ($answers as $answer) {

                // Инициализация объекта задания
                switch ($answer['exerciseId']) {
                    case 'select1':
                        $ex = new ExerciseSelect();
                        break;

                    case 'input1':
                        $ex = new ExerciseInput();

                    default:
                        # Может быть Exception, или дефолтная обработка данных
                        # зависит от поставленной задачи
                        $ex = new ExerciseDefault();
                        break;
                }

                // Обработка данных
                $ex->setAnswers($answer);
                $ex->saveAnswers();

                $responseData[] = [
                    'isCorrect' => $ex->getIsAnswerCorrect(),
                    'score' => $ex->getAnswerPoint(),
                ];
            }
            return $responseData;
        }
        return false;
    }
}


interface IExercise
{
    public function setAnswers(array $asnwers);

    public function saveAnswers();

    public function getIsAnswerCorrect();

    public function getAnswerPoint();
}

class ExerciseDefault implements IExercise
{
    private $_answers;

    public function setAnswers(array $answers)
    {
        $this->_answers = $answers;
    }

    public function saveAnswers()
    {
        return $this->saveAnswersToDb();
    }

    public function getIsAnswerCorrect()
    {
        // Метод высчитывает правильность указанного ответа
    }

    public function getAnswerPoint()
    {
        // Метод высчитывает штрафы и бонусы за не/правильный ответ
    }

    protected function saveAnswersToDb()
    {
        // Метод сохранения данных в БД
    }
}

class ExerciseSelect extends ExerciseDefault implements IExercise
{
    ...
}
class ExerciseInput extends ExerciseDefault implements IExercise
{
    ...
}
