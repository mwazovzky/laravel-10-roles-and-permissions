# Laravel Role Based Access Control (RBAC)

## User Role Basic Usage

```php
$user = User::first();
$company = Company::first();
$client = Client::first();

$admin = Role::where('name', 'app.admin')->first();
$companyAdmin = Role::where('name', 'company.admin')->first();
$clientAdmin = Role::where('name', 'client.admin')->first();
// attach roles to user
$user->roles()->attach($admin->id, ['scope_type' => 'admin', 'scope_id' => null]);
$user->roles()->attach($companyAdmin->id, ['scope_type' => 'company', 'scope_id' => $company->id]);
$user->roles()->attach($clientAdmin->id, ['scope_type' => 'client', 'scope_id' => $client->id]);
// check user permissions
$user->hasAdminPermission('transaction.create');
$user->hasCompanyPermission($company, 'transaction.create');
$user->hasClientPermission($client, 'transaction.create');
```
