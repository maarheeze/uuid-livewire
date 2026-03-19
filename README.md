# maarheeze/uuid-livewire

Livewire integration for [maarheeze/uuid](https://github.com/maarheeze/uuid).

Livewire serializes component properties between requests. Without this package, it does not know how to handle `Uuid` value objects and will fail when one is used as a property. This package registers a property synthesizer that teaches Livewire how to serialize and deserialize `Uuid` instances automatically.

## Requirements

- PHP 8.2+
- Livewire 4.2+

## Installation

```bash
composer require maarheeze/uuid-livewire
```

## Usage

### Custom Livewire components

Declare a `Uuid` property directly — no manual conversion needed.

```php
use Livewire\Component;
use Maarheeze\Uuid\Uuid;

class ShowArticle extends Component
{
    public Uuid $articleId;
}
```

### Filament

Filament pages are Livewire components. When a Filament resource uses a `Uuid` as its primary key, Livewire needs to serialize it between requests — for example, when loading an edit page. Without this package, Filament will fail to keep track of the record.

```php
use Filament\Resources\Resource;
use App\Models\Article; // model with a Uuid primary key

class ArticleResource extends Resource
{
    protected static string $model = Article::class;
}
```

No additional configuration is required in either case — installing this package is enough.

## License

MIT