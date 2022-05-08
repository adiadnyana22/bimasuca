<!-- Tidak ada pencarian -->
<?php if(!isset($_GET['cari'])): ?>
                            <?php for($i=1; $i<=$jumlahHalaman; $i++): ?>
                                <?php  if($halamanAktif == $i): ?>

                                <?php else: ?>

                                <?php  endif; ?>
                            <?php endfor; ?>
                        <!-- Ada pencarian -->
                        <?php else: ?>
                            <?php for($i=1; $i<=$jumlahHalaman; $i++): ?>
                                <?php  if($halamanAktif == $i): ?>

                                <?php else: ?>

                                <?php  endif; ?>

                            <?php endfor; ?>

                        <?php endif; ?>