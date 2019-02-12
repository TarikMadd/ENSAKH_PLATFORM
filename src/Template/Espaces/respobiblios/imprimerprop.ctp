<?php $this->layout = 'AdminLTE.print'; ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8"/>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" rel="stylesheet"/>
<?php echo $this->Html->css(['nain', 'fancy', 'base']); ?>
</head>
<body style="    margin-right: 20px; margin-left: 20px;">

<div style=" text-align: left;"  >
  <td ><?php echo $this->Html->image('../../img/books/ensak.png'); ?></td>
</div>
    <h3 style=" text-align: center;">L’Ecole Nationale des Sciences Appliquées de Khouribga</h3>
<br />
<h3 style=" text-align: center;">
Demande d'achat d'un ouvrage pour la bibliothèque<br>
<br> Année universitaire 2016/2017 <br><br></h3>

<p >  

      <table class="table table-bordered table-striped">
                  <col width="30">
                  <col width="100">
                  <col width="130">
                  <col width="130">                   
                  <col width="100">
                   <col width="200">
               <col width="100">
              
                  <thead>
                      <tr>
                       
                      </tr>
                      <tr>
                        <th>N°</th>
                        <th>Nom&Prenom</th>
                        <th>Role</th>
                         <th>CNE/SOM</th>
                          <th>Email</th>
                         <th>Résumé</th>
                        <th>Image</th>                                   
                      </tr>
                    </thead>
                    <tbody>
                    
                      <tr>
                        <td><?php echo $search['id']; ?></td>
                        <td><?php echo $search['Utulisateur']; ?></td>
                        <td><?php echo $search['role']; ?></td>
                        <td><?php echo $search['CNE/SOM']; ?></td> 
                         <td><?php echo $search['email']; ?></td> 
                        <td><?php echo $search['resumé']; ?></td>  
                       <td><?php echo $this->Html->image('../../img/books/'.$search['image'],['height' =>'200'],['width' =>'200'],['alt' =>'CakePHP']); ?></td>    
   
                    </tbody>
                    
                  </table> 

</body>
</html>
