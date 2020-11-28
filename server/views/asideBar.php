<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="<?php echo constant('URL')?>" class="nav-link <?php if ($this->tab == "dashboard") echo "active" ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    <?php echo $this->strings['nav_dashboard']?>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo constant('URL')?>clients" class="nav-link <?php if ($this->tab == "clients") echo "active" ?>">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    <?php echo $this->strings['nav_clients']?>
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview <?php if ($this->tab == "books") echo "menu-open" ?>">
          <a href="#" class="nav-link <?php if ($this->tab == "books") echo "active" ?>">
            <i class="nav-icon fas fa-book"></i>
            <p>
              <?php echo $this->strings['nav_books']?>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo constant('URL')?>books" class="nav-link <?php if ($this->tab == "books" && $this->subTab=="list") echo "active" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php echo $this->strings['nav_all_books']?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo constant('URL')?>books/add" class="nav-link <?php if ($this->tab == "books" && $this->subTab=="add") echo "active" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php echo $this->strings['nav_add_books']?></p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?php if ($this->tab == "categories") echo "menu-open" ?>">
          <a href="#" class="nav-link <?php if ($this->tab == "categories") echo "active" ?>">
            <i class="nav-icon fas fa-list"></i>
            <p>
              <?php echo $this->strings['nav_categories']?>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo constant('URL')?>categories" class="nav-link <?php if ($this->tab == "categories" && $this->subTab=="list") echo "active" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php echo $this->strings['nav_all_categories']?></p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo constant('URL')?>categories/add" class="nav-link <?php if ($this->tab == "categories" && $this->subTab=="add") echo "active" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p><?php echo $this->strings['nav_add_categories']?></p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
            <a href="<?php echo constant('URL')?>orders" class="nav-link <?php if ($this->tab == "orders") echo "active" ?>">
                <i class="nav-icon fas fa-boxes"></i>
                <p>
                    <?php echo $this->strings['nav_orders']?>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo constant('URL'); ?>login/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  <?php echo $this->strings['nav_logout']?>
                </p>
            </a>
        </li>
    </ul>
</nav>