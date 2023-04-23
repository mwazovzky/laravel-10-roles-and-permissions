# Laravel Role Based Access Control (RBAC)

## User Role Basic Usage

```php
$user = User::find(1);
$company = Company::find(1);
$client = Client::find(1);

$appAdmin = Role::find(1);
$companyAdmin = Role::find(2);
$clientAdmin = Role::find(3);

$user->attachAdminRole($appAdmin);
$user->attachCompanyRole($company, $companyAdmin);
$user->attachClientRole($client, $clientAdmin);

$user->fresh();

$user->companies;
$user->clients;

$user->adminRoles()->get();
$user->companyRoles($company)->get();
$user->clientRoles($client)->get();

$user->hasAdminPermission('client.view');
$user->hasCompanyPermission($company, 'client.view');
$user->hasClientPermission($client, 'client.view');
```
