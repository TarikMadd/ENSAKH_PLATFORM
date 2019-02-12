<?php foreach ($books as $book): ?>
<tr>

<td><?php echo $book['id']; ?></td> 
<td><?php echo $book['somme']; ?></td>
<td><?php echo $book['nom_vacataire']; ?></td>
<tr>
<?php endforeach; ?>