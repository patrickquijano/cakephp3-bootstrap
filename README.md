# Bootstrap 4 plugin for CakePHP 3

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

The recommended way to install composer packages is:

```
composer require patrickquijano/cakephp3-bootstrap4:dev-master
```

Load the plugin by using the bake command:

```
$ bin/cake plugin load Bootstrap
```

Load the plugin by adding the following statement in your project's src/Application.php:

```
public function bootstrap() {
    parent::bootstrap();
    $this->addPlugin('Bootstrap');
}
```

Prior to 3.6.0:

```
Plugin::load('Bootstrap');
```

## Usage

Modify the AppView to use the trait BootstrapViewTrait:

```
namespace App\View;

use Cake\View\View;
use Bootstrap\View\BootstrapViewTrait;

class AppView extends View {

    use BootstrapViewTrait;

    public function initialize() {
        // other initialization here.
        $this->initializeBootstrap();
        // other initialization here.
    }

}
```

You can also load each helper:

```
namespace App\View;

use Cake\View\View;

class AppView extends View {

    public function initialize() {
        // other initialization here.
        $this->loadHelper('Bootstrap.Bootstrap');
        $this->loadHelper('Html', ['className' => 'Bootstrap.BootstrapHtml']);
        $this->loadHelper('Form', ['className' => 'Bootstrap.BootstrapForm']);
        $this->loadHelper('Paginator', ['className' => 'Bootstrap.BootstrapPaginator']);
        // other initialization here.
    }

}
```

Load the stylesheets and javascripts in your layouts using the helper:

```
<?= $this->Bootstrap->css(); ?>
// Your jQuery load script here
<?= $this->Bootstrap->script(); ?>
```

Make sure to load the jQuery before running the $this->Bootstrap->script().

Modify the AppController to load the Flash component:

```
class AppController extends Controller {

    public function initialize() {
        parent::initialize();
        // other initialization here.
        $this->loadComponent('Flash', ['className' => 'Bootstrap.BootstrapFlash']);
        // other initialization here.
    }

}
```