<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ActiveForm;
use backend\models\Review;
use backend\models\Students;
use backend\models\EntryForm;
use yii\helpers\Url;
use kartik\icons\Icon;

Icon::map($this); 



?>

<div class="post">

<?php
      $user_id=Yii::$app->user->id;
            $email=Yii::$app->user->identity->email;

            $students=null;
            $students=Students::find()
                ->where(['email'=>$email])
                ->one();
            $student_id=$students->id;
            $coordinator_id=$students->coordinator_id;
            $event_id=$model->event_id;

      $review=null;
            $review = Review::find()
                ->where(['event_id' => $event_id, 'student_id' => $student_id])
                ->one();
            
            $todayDate=date("Y-m-d");
            $registrationDate=$model->registration_date; 
?>
            

           <?php if($review==null&&($coordinator_id==$model->coordinator_id)&&$todayDate<=$registrationDate){?>


     
     
      
      
     <!DOCTYPE html>
<html>
<head>

</head>
<body>

<div class="rcorners1" style="color:white" font-size: 30px > 
  <h1><?= Html::encode($model->event_name) ?><br></h1>
     <h4><?= HtmlPurifier::process($model->event_description) ?></h4>  <br>  
      <?= Html::a('<i class="fa fa-fw fa-crosshairs", style="color:purple;font-size:20px"></i> ',[''], ['class' => 'btn btn-black', 'title' => 'Sign Up']) ?><?= HtmlPurifier::process($model->venue) ?>     <br>
      <?= Html::a('<i class="fas fa-calendar-alt", style="color:purple;font-size:20px"></i> ',[''], ['class' => 'btn btn-black', 'title' => 'Sign Up']) ?><?= HtmlPurifier::process($model->event_date) ?>     <br>
      Registration Till:   <?= HtmlPurifier::process($model->registration_date) ?>     <br><br>
      <?=Html::a(' Register', ['/site/register-student', 'event_id' => $model->event_id,'registration_index'=>$model->registration_index,'event_name'=>$model->event_name], 
      ['class'=>'btn btn-primary'])?></div>

</body>
</html>
<br>

      <?php } ?> 



            <?php
      
      if($review!=null&&($coordinator_id==$model->coordinator_id)&&
      $todayDate<=$registrationDate) { 
            

            $registration_index=$review->registration_index;
            

            if($registration_index==1){?>
          
           
<!DOCTYPE html>
<html>
<body>

<div class="rcorners1" style="color:white" font-size: 30px>
      <h1><?= Html::encode($model->event_name) ?><br></h1> 
     <h4><?= HtmlPurifier::process($model->event_description) ?><h4><br>  
      <?= Html::a('<i class="fa fa-fw fa-crosshairs", style="color:purple;font-size:20px"></i> ',[''], ['class' => 'btn btn-black', 'title' => 'Sign Up']) ?><?= HtmlPurifier::process($model->venue) ?>     <br>
      <?= Html::a('<i class="fas fa-calendar-alt", style="color:purple;font-size:20px"></i> ',[''], ['class' => 'btn btn-black', 'title' => 'Sign Up']) ?><?= HtmlPurifier::process($model->event_date) ?>     <br>
      Registration Till:   <?= HtmlPurifier::process($model->registration_date) ?>     <br><br>
        
      <div class="undobutton">
                <?=Html::a(' Undo Registeration', ['/site/register-student', 'event_id' => $model->event_id,'registration_index'=>$model->registration_index,'event_name'=>$model->event_name], ['class'=>'btn btn-primary'])?>

      </div>
      </div>

</body>
</html>

           <br><br><br>
          

           <?php $form = ActiveForm::begin([
            'id' => 'EntryForm',
            'enableClientValidation' => true,
          'action' => Url::to(['/site/approve','event_id' => $model->event_id,'student_id'=>$student_id]),
          'method' => 'post',
          'options' => [
                'class' => 'form-horizontal',

          ]
      ]);
 
      ?>      
           
            <?php     
            $entryModel = new EntryForm();
            $entryModel->eventID=$event_id;
      $entryModel->studentID=$student_id;
      
      ?>
             
<div class="rcorners2">
  <?= $form->field($entryModel, 'number_of_hours') ?>
      <?= $form->field($entryModel, 'work_statement') ?>
          <div class="form-group">
          <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Submit for Approval',

             ['class' => 'btn btn-primary']) ?>
           </div>
        </div>
        </div>

      
  
        <?php ActiveForm::end();?>

        <br><br><br>
            <?php } if($registration_index==2) {?>

        
      <!DOCTYPE html>
<html>

<body>

<div class="rcorners1" style="color:white">
  
  <h1><?= Html::encode($model->event_name) ?></h1>
  <!-- <p class="rcorners1" style="color:white"> -->
     <h4><?= HtmlPurifier::process($model->event_description) ?><h4><br>   
       <?= Html::a('<i class="fa fa-fw fa-crosshairs", style="color:purple;font-size:20px"></i> ',[''], ['class' => 'btn btn-black', 'title' => 'Sign Up']) ?><?= HtmlPurifier::process($model->venue) ?>     <br>
      <?= Html::a('<i class="fas fa-calendar-alt", style="color:purple;font-size:20px"></i> ',[''], ['class' => 'btn btn-black', 'title' => 'Sign Up']) ?><?= HtmlPurifier::process($model->event_date) ?>     <br>
      Registration Till:   <?= HtmlPurifier::process($model->registration_date) ?>     <br>
       Work Statement::   <?= HtmlPurifier::process($review->work_statement) ?>     <br>
      Number of hours::   <?= HtmlPurifier::process($review->no_of_hours) ?>     <br>
                

        <?=Html::a(' Undo Approval Request', ['/site/undo-request', 'event_id' => $model->event_id,'student_id'=>$student_id], ['class'=>'btn btn-primary'])?>
            <br><br><br>
            </div>           
</body>
</html><br><br>

            
           
             
        






         <?php } if($registration_index==3) {?>
      

      <!DOCTYPE html>
<html>

<body>

<div class="rcorners1" style="color:white">
     <h4> <?= HtmlPurifier::process($model->event_description) ?><h4>  <br>  
      <?= Html::a('<i class="fa fa-fw fa-crosshairs", style="color:purple;font-size:20px"></i> ',[''], ['class' => 'btn btn-black', 'title' => 'Sign Up']) ?><?= HtmlPurifier::process($model->venue) ?>     <br>
      <?= Html::a('<i class="fas fa-calendar-alt", style="color:purple;font-size:20px"></i> ',[''], ['class' => 'btn btn-black', 'title' => 'Sign Up']) ?><?= HtmlPurifier::process($model->event_date) ?>     <br>
      Registration Till:   <?= HtmlPurifier::process($model->registration_date) ?>     <br>
      Work Statement:   <?= HtmlPurifier::process($review->work_statement) ?>     <br>
      Number of hours:   <?= HtmlPurifier::process($review->no_of_hours) ?>     <br>
      <h2>Approved by Coordinator <h2>
        <br><br><br></div>

</body>
</html>

      
  <?php }

  }?>
    




 </div>




<style type="text/css"> 
.rcorners1 {
  border-radius: 25px;
  background: #1a1a1a;
  padding: 50px; 
  width: 500px;
  height: 340px;  
}
.rcorners2 {
 border-radius: 25px;
  border: 2px solid #1a1a1a;
  padding: 50px; 
  width: 500px;
  height: 290px;  
}
.undobutton {
position: absolute;
}


</style>




