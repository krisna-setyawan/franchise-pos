<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">

			<ul>
				<?php foreach ($menus as $lv1) { ?>
					<?php if ($lv1['level'] == 1) { ?>

						<?php if ($lv1['has_child'] == 'n') { ?>
							<li class="<?= $this->uri->segment(1) ==  $lv1['url'] ? 'active' : '' ?>">
								<a href="<?= base_url() ?><?= $lv1['url'] ?>"><?= $lv1['icon'] ?><span> <?= $lv1['menu'] ?></span> </a>
							</li>
						<?php } else { ?>
							<li class="submenu <?= $this->uri->segment(1) ==  $lv1['url'] ? 'active' : '' ?>">
								<a href="javascript:void(0);"><?= $lv1['icon'] ?><span> <?= $lv1['menu'] ?></span> <span class="menu-arrow"></span></a>
								<ul>
									<?php foreach ($menus as $lv2) { ?>
										<?php if ($lv2['level'] == 2) { ?>
											<?php if ($lv2['parent'] == $lv1['id']) { ?>
												<li><a class="<?= $this->uri->segment(1) ==  $lv2['url'] ? 'active' : '' ?>" href="<?= base_url() ?><?= $lv2['url'] ?>"><?= $lv2['menu'] ?></a></li>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>

					<?php } ?>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
