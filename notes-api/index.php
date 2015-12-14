 <?php

require_once __DIR__ . '/vendor/autoload.php';
 //require_once __DIR__ . '';

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Notes\Persistence\Entity\MysqlUserRepository;
use Notes\Domain\Entity\UserFactory;
use Notes\Domain\ValueObject\StringLiteral;

$app = new Application();
$app['debug'] = true;


 $dsn = 'mysql:dbname=testdb;host=127.0.0.1';
 $username = 'root';
 $password = '123456';

 $repo = new MysqlUserRepository($dsn, $username, $password);
 $userFactory = new UserFactory();

$app->get('/', function() {

	return new Response('Final Project API', 200);
});

$app->get('/users', function(Request $request) use ($repo) {

    $sort = strtolower($request->get("sort-username"));

    $users = $repo->getUsers();
    /* ran out of time cuz my virtual machine crashed, so i didnt implement them!!
    if($sort == 'dsc') {

    }
    elseif($sort == "asc") {

    }*/
    return new Response(
        json_encode($users),
        200,
        ['Content-Type' => 'application/json']
    );
});
$app->post('/users', function(Application $app, Request $request) use ($repo, $userFactory) {

    $user = $userFactory->create();
    $user->setUsername(new StringLiteral("userFromPOST"));
    $newUser = $repo->add($user);
    return $app->json($repo->getUsers(), 201);

});

$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});


$app->run();