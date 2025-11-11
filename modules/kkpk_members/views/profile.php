<h1>My Profile</h1>

<?php if (isset($member)): ?>
  <table class="table table-bordered" cellpadding="6" cellspacing="0" width="100%">
    <tr>
      <th>No. KKPK</th>
      <td><?= $member->no_kkpk ?></td>
    </tr>
    <tr>
      <th>Nama Penuh</th>
      <td><?= $member->nama_penuh ?></td>
    </tr>
    <tr>
      <th>No. KP</th>
      <td><?= $member->no_kp ?></td>
    </tr>
    <tr>
      <th>No. Telefon</th>
      <td><?= $member->no_telefon ?></td>
    </tr>
    <tr>
      <th>Emel</th>
      <td><?= $member->emel ?></td>
    </tr>
    <tr>
      <th>Alamat</th>
      <td><?= nl2br($member->alamat) ?></td>
    </tr>
    <tr>
      <th>Nama Syarikat / Perniagaan</th>
      <td><?= $member->nama_syarikat_perniagaan ?></td>
    </tr>
    <tr>
      <th>Jenis Industri</th>
      <td><?= $member->jenis_industri ?></td>
    </tr>
    <tr>
      <th>Pekerjaan / Jawatan</th>
      <td><?= $member->pekerjaan_jawatan ?></td>
    </tr>
    <tr>
      <th>Kepakaran</th>
      <td><?= $member->kepakaran ?></td>
    </tr>
    <tr>
      <th>Tujuan Menyertai</th>
      <td><?= nl2br($member->tujuan) ?></td>
    </tr>
    <tr>
      <th>Referral</th>
      <td><?= $member->referral ?></td>
    </tr>
    <tr>
      <th>Syer 1000</th>
      <td><?= $member->syer_1000 ? '✔' : '-' ?></td>
    </tr>
    <tr>
      <th>Syer 100</th>
      <td><?= $member->syer_100 ? '✔' : '-' ?></td>
    </tr>
    <tr>
      <th>Daftar 20</th>
      <td><?= $member->daftar_20 ? '✔' : '-' ?></td>
    </tr>
    <tr>
      <th>Catatan</th>
      <td><?= nl2br($member->catatan) ?></td>
    </tr>
  </table>

  <p>
    <a href="<?= BASE_URL ?>kkpk_members/edit/<?= $member->id ?>" class="btn btn-warning">Edit Profile</a>
    <a href="<?= BASE_URL ?>kkpk_members/logout" class="btn btn-secondary">Logout</a>
  </p>
<?php else: ?>
  <p>Profile not found.</p>
<?php endif; ?>
