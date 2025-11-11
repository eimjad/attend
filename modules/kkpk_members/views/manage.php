<h1>KKPK Members Management</h1>

<?php
if (isset($flash)) {
  echo '<p class="flash">'.$flash.'</p>';
}
?>

<p>
  <a href="<?= BASE_URL ?>kkpk_members/create" class="btn btn-primary">+ Add New Member</a>
</p>

<?php if (isset($members) && count($members) > 0): ?>
  <table class="table table-striped" border="1" cellpadding="6" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>No. KKPK</th>
        <th>Nama Penuh</th>
        <th>No. KP</th>
        <th>Emel</th>
        <th>No. Telefon</th>
        <th>Jawatan</th>
        <th>Syer 1000</th>
        <th>Syer 100</th>
        <th>Daftar 20</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($members as $member): ?>
        <tr>
          <td><?= $member->id ?></td>
          <td><?= $member->no_kkpk ?></td>
          <td><?= $member->nama_penuh ?></td>
          <td><?= $member->no_kp ?></td>
          <td><?= $member->emel ?></td>
          <td><?= $member->no_telefon ?></td>
          <td><?= $member->jawatan_kkpk ?></td>
          <td><?= $member->syer_1000 ? '✔' : '-' ?></td>
          <td><?= $member->syer_100 ? '✔' : '-' ?></td>
          <td><?= $member->daftar_20 ? '✔' : '-' ?></td>
          <td>
            <a href="<?= BASE_URL ?>kkpk_members/show/<?= $member->id ?>">View</a> |
            <a href="<?= BASE_URL ?>kkpk_members/edit/<?= $member->id ?>">Edit</a> |
            <a href="<?= BASE_URL ?>kkpk_members/deleteconf/<?= $member->id ?>" onclick="return confirm('Delete this member?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No members found.</p>
<?php endif; ?>
