# Configuration

You can publish the SilverOwl configuration via `php artisan publish`

| Key        | Default                                      | Usage                                 |
|------------|----------------------------------------------|---------------------------------------|
| user_model | /AnthonyEdmonds/SilverOwl/Models/User::class | The User model used across the system |

## Using a custom User model

If you want to use your own User model, make sure that you extend the SilverOwl User model to preserve the necessary scopes and relationships.
