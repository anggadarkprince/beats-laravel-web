@extends('template')

@section('content')

    <div class="media profile">
        <a class="pull-left" href="#">
            <img class="img-responsive" data-src="holder.js/140x140" alt="140x140" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIwAAACMCAYAAACuwEE+AAAFOUlEQVR4Xu3YZ0ujURCG4YkgFuyoiGLBiiJi+f+/QLGBqNjLBwvG3sCyzIGIyeqSwTEks7dfXHGYN/PMtScnZrLZ7LvwRQJFJpABTJFJUZYSAAwQTAkAxhQXxYDBgCkBwJjiohgwGDAlABhTXBQDBgOmBABjiotiwGDAlABgTHFRDBgMmBIAjCkuigGDAVMCgDHFRTFgMGBKADCmuCgGDAZMCQDGFBfFgMGAKQHAmOKiGDAYMCUAGFNcFAMGA6YEAGOKi2LAYMCUAGBMcVEMGAyYEgCMKS6KAYMBUwKAMcVFMWAwYEoAMKa4KAYMBkwJAMYUF8WAwYApAcCY4qIYMBgwJQAYU1wUAwYDpgQAY4qLYsBgwJQAYExxUQwYDJgSAIwpLooBgwFTAoAxxUUxYDBgSgAwprgoBgwGTAkAxhQXxYDBgCkBwJjiohgwGDAlABhTXBQDBgOmBABjiotiwGDAlABgTHFRDBgMmBIAjCkuigGDAVMCgDHFRTFgMGBKoOLBPD4+ytLSUhp6dnZWamtr8wLY2NiQ4+NjGR4eloGBgfS7g4MD2d3dldfXV2lsbJSJiYn0vZivUj+vmNdUypqKBfP+/i7n5+eyubkpz8/PUl9f/xeYbDYrq6ur8vLy8gHm+vpaVlZWpLm5OQHSfyuW6elpyWQy32Zf6ueVEoHlWRUL5vb2VhYXF0UX+fb2lk6WzyeMnh6K4fLyMtXkThg9Xba2tmRkZET6+/tlfn5enp6eZGZmJgHUk6ejoyPVLy8vp1NoampKqqqq3J/X0NBg2VVZ1FYsmLu7u7T47u5u0bed6urqPDCHh4eys7MjLS0tcnFx8QFmbW1Nzs7OZHx8XLq6uj5QTU5OplpF+PDwIE1NTQmbnkJDQ0PyG89rb28vCwSWF1GxYHJD5k6az2By94y6urqEQOHkTphCMIU/n5ycyPr6ejpZ9ASYm5tLGH/reZZllUNtSDB64ugpom8lV1dXsr29XdQJo//j9b6zsLCQTpS+vj4ZHR3N29NXQH/yvHJAYHkN4cDo8Lm3lcIg9JTRi+13dxg9Ufb29tI9Ru89NTU1CZ1ekL87YX76PMuyyqE2HJjCj9X7+/t5J4zeS/Qy3NraKoODg+liq1D0U9L9/X36iK6oOjs75ejoSNra2vI+QX11wnxepOV5//pUVg44vnoN/x0YDUEh6L1G335yf4dRNHqfOT09TZB6e3sTppubGxkbG5Oenp6UnxXMd88r9u8+5Qan4sGUW6DRXw9gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/YeT7AOAcavR1gom/Yeb4/HZAutcoP83oAAAAASUVORK5CYII=" style="width: 140px; height: 140px;">
        </a>
        <div class="media-body">
            <h2 class="title">Avril Lavigne</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium atque blanditiis libero qui voluptatum! Amet architecto dignissimos ea ipsam minima non quidem! Corporis deleniti ducimus laborum maxime odio odit voluptate.</p>
            <p class="text-muted">California USA | 25 January 1985 | Pieces</p>
        </div>
    </div>

    <h3 class="profile-label">Albums : Let's Go (2004)</h3>
    <p class="subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam deserunt dignissimos ducimus ea earum explicabo fugit ipsum iure magni minima nemo nobis numquam, optio porro quasi quos similique voluptas. Illum!</p>
    <div class="song">
        <div class="media song-list">
            <a class="pull-left" href="{{ route('public_song',['avril-lavigne','lets-go','when-youre-gone']) }}">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACe0lEQVR4Xu2Y54oqQRSES8WIqIgJxICKCRFB3/8JxARGzAoGzBgQFJfToLj3snd3Z3Dvoqf/CGKf6a6uU9/YisViccELDwULwA7gFuAMeOEMBIcgU4ApwBRgCjAFXlgBxiBjkDHIGGQMvjAE+M8QY5AxyBhkDDIGGYMvrIBsDM5mM9TrdRwOB2i1WoTDYTidzneS1mo1DIdDhEIh+P3+T+V+RM2PHipLgO12i3w+D5PJhGAwiEKhAI1Gg1QqJT5pLBYLlEolnE6nLwnwiJr/UlyWAP1+H61WC7FYDC6X66/nnM9nFItFLJdLXC6XmwCdTgftdht2u118R8LRb5PJJNbrtaSan9rqgx/IEqBSqWA8HgvrUwvodDpEo1HYbDbxuKtAFosF8/n8JgC5IZfLYb/fC/eQQNQa5CKpNf+LAOVyGaPRSJw+bYBOUqVSIZPJCMtTe+j1epAA5JT7DCDhqtWqOHmj0Yh0Og21Wg05NaWIIMsBtNjJZIJ4PC5EoA2ThROJBCjIptOpsPVqtUKz2XwnAAmUzWZBPe/1ekV40pBT88cF6PV64mQjkQjcbvet32kz3W5XWPzPcXXBNQcoG6iFSCiz2Qw5NX9cgGtiGwwG0fsUeEql8mbn64JIjHsHXOcpFAo4HA4MBgNYrVZBj91uJ5z03ZpSNk9zZLUAFaAWaDQaOB6PYtHUDtTz9+NeAJ/Pd7N5IBCAx+MR2bHZbG5O+m7Nr7xbPOQ9QKrqv2mebAf8ps1IWQsLwDdCfCPEN0J8IyQlPZ9lDlOAKcAUYAowBZ4l0aXsgynAFGAKMAWYAlLS81nmMAWYAkwBpgBT4FkSXco+mAKvToE3EUN4nw3vFosAAAAASUVORK5CYII=" style="width: 64px; height: 64px;">
            </a>
            <div class="media-body">
                <div class="pull-left">
                    <h4 class="title">When you're gone</h4>
                    <p class="artist">Avril Lavigne</p>
                </div>
                <div class="pull-right text-right">
                    <p class="album">Goodbye Lullaby</p>
                    <time class="duration">04:12</time>
                </div>
            </div>
        </div>
        <div class="media song-list">
            <a class="pull-left" href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACe0lEQVR4Xu2Y54oqQRSES8WIqIgJxICKCRFB3/8JxARGzAoGzBgQFJfToLj3snd3Z3Dvoqf/CGKf6a6uU9/YisViccELDwULwA7gFuAMeOEMBIcgU4ApwBRgCjAFXlgBxiBjkDHIGGQMvjAE+M8QY5AxyBhkDDIGGYMvrIBsDM5mM9TrdRwOB2i1WoTDYTidzneS1mo1DIdDhEIh+P3+T+V+RM2PHipLgO12i3w+D5PJhGAwiEKhAI1Gg1QqJT5pLBYLlEolnE6nLwnwiJr/UlyWAP1+H61WC7FYDC6X66/nnM9nFItFLJdLXC6XmwCdTgftdht2u118R8LRb5PJJNbrtaSan9rqgx/IEqBSqWA8HgvrUwvodDpEo1HYbDbxuKtAFosF8/n8JgC5IZfLYb/fC/eQQNQa5CKpNf+LAOVyGaPRSJw+bYBOUqVSIZPJCMtTe+j1epAA5JT7DCDhqtWqOHmj0Yh0Og21Wg05NaWIIMsBtNjJZIJ4PC5EoA2ThROJBCjIptOpsPVqtUKz2XwnAAmUzWZBPe/1ekV40pBT88cF6PV64mQjkQjcbvet32kz3W5XWPzPcXXBNQcoG6iFSCiz2Qw5NX9cgGtiGwwG0fsUeEql8mbn64JIjHsHXOcpFAo4HA4MBgNYrVZBj91uJ5z03ZpSNk9zZLUAFaAWaDQaOB6PYtHUDtTz9+NeAJ/Pd7N5IBCAx+MR2bHZbG5O+m7Nr7xbPOQ9QKrqv2mebAf8ps1IWQsLwDdCfCPEN0J8IyQlPZ9lDlOAKcAUYAowBZ4l0aXsgynAFGAKMAWYAlLS81nmMAWYAkwBpgBT4FkSXco+mAKvToE3EUN4nw3vFosAAAAASUVORK5CYII=" style="width: 64px; height: 64px;">
            </a>
            <div class="media-body">
                <div class="pull-left">
                    <h4 class="title">When you're gone</h4>
                    <p class="artist">Avril Lavigne</p>
                </div>
                <div class="pull-right text-right">
                    <p class="album">Goodbye Lullaby</p>
                    <time class="duration">04:12</time>
                </div>
            </div>
        </div>
        <div class="media song-list">
            <a class="pull-left" href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACe0lEQVR4Xu2Y54oqQRSES8WIqIgJxICKCRFB3/8JxARGzAoGzBgQFJfToLj3snd3Z3Dvoqf/CGKf6a6uU9/YisViccELDwULwA7gFuAMeOEMBIcgU4ApwBRgCjAFXlgBxiBjkDHIGGQMvjAE+M8QY5AxyBhkDDIGGYMvrIBsDM5mM9TrdRwOB2i1WoTDYTidzneS1mo1DIdDhEIh+P3+T+V+RM2PHipLgO12i3w+D5PJhGAwiEKhAI1Gg1QqJT5pLBYLlEolnE6nLwnwiJr/UlyWAP1+H61WC7FYDC6X66/nnM9nFItFLJdLXC6XmwCdTgftdht2u118R8LRb5PJJNbrtaSan9rqgx/IEqBSqWA8HgvrUwvodDpEo1HYbDbxuKtAFosF8/n8JgC5IZfLYb/fC/eQQNQa5CKpNf+LAOVyGaPRSJw+bYBOUqVSIZPJCMtTe+j1epAA5JT7DCDhqtWqOHmj0Yh0Og21Wg05NaWIIMsBtNjJZIJ4PC5EoA2ThROJBCjIptOpsPVqtUKz2XwnAAmUzWZBPe/1ekV40pBT88cF6PV64mQjkQjcbvet32kz3W5XWPzPcXXBNQcoG6iFSCiz2Qw5NX9cgGtiGwwG0fsUeEql8mbn64JIjHsHXOcpFAo4HA4MBgNYrVZBj91uJ5z03ZpSNk9zZLUAFaAWaDQaOB6PYtHUDtTz9+NeAJ/Pd7N5IBCAx+MR2bHZbG5O+m7Nr7xbPOQ9QKrqv2mebAf8ps1IWQsLwDdCfCPEN0J8IyQlPZ9lDlOAKcAUYAowBZ4l0aXsgynAFGAKMAWYAlLS81nmMAWYAkwBpgBT4FkSXco+mAKvToE3EUN4nw3vFosAAAAASUVORK5CYII=" style="width: 64px; height: 64px;">
            </a>
            <div class="media-body">
                <div class="pull-left">
                    <h4 class="title">When you're gone</h4>
                    <p class="artist">Avril Lavigne</p>
                </div>
                <div class="pull-right text-right">
                    <p class="album">Goodbye Lullaby</p>
                    <time class="duration">04:12</time>
                </div>
            </div>
        </div>
        <div class="media song-list">
            <a class="pull-left" href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACe0lEQVR4Xu2Y54oqQRSES8WIqIgJxICKCRFB3/8JxARGzAoGzBgQFJfToLj3snd3Z3Dvoqf/CGKf6a6uU9/YisViccELDwULwA7gFuAMeOEMBIcgU4ApwBRgCjAFXlgBxiBjkDHIGGQMvjAE+M8QY5AxyBhkDDIGGYMvrIBsDM5mM9TrdRwOB2i1WoTDYTidzneS1mo1DIdDhEIh+P3+T+V+RM2PHipLgO12i3w+D5PJhGAwiEKhAI1Gg1QqJT5pLBYLlEolnE6nLwnwiJr/UlyWAP1+H61WC7FYDC6X66/nnM9nFItFLJdLXC6XmwCdTgftdht2u118R8LRb5PJJNbrtaSan9rqgx/IEqBSqWA8HgvrUwvodDpEo1HYbDbxuKtAFosF8/n8JgC5IZfLYb/fC/eQQNQa5CKpNf+LAOVyGaPRSJw+bYBOUqVSIZPJCMtTe+j1epAA5JT7DCDhqtWqOHmj0Yh0Og21Wg05NaWIIMsBtNjJZIJ4PC5EoA2ThROJBCjIptOpsPVqtUKz2XwnAAmUzWZBPe/1ekV40pBT88cF6PV64mQjkQjcbvet32kz3W5XWPzPcXXBNQcoG6iFSCiz2Qw5NX9cgGtiGwwG0fsUeEql8mbn64JIjHsHXOcpFAo4HA4MBgNYrVZBj91uJ5z03ZpSNk9zZLUAFaAWaDQaOB6PYtHUDtTz9+NeAJ/Pd7N5IBCAx+MR2bHZbG5O+m7Nr7xbPOQ9QKrqv2mebAf8ps1IWQsLwDdCfCPEN0J8IyQlPZ9lDlOAKcAUYAowBZ4l0aXsgynAFGAKMAWYAlLS81nmMAWYAkwBpgBT4FkSXco+mAKvToE3EUN4nw3vFosAAAAASUVORK5CYII=" style="width: 64px; height: 64px;">
            </a>
            <div class="media-body">
                <div class="pull-left">
                    <h4 class="title">When you're gone</h4>
                    <p class="artist">Avril Lavigne</p>
                </div>
                <div class="pull-right text-right">
                    <p class="album">Goodbye Lullaby</p>
                    <time class="duration">04:12</time>
                </div>
            </div>
        </div>
        <div class="media song-list">
            <a class="pull-left" href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACe0lEQVR4Xu2Y54oqQRSES8WIqIgJxICKCRFB3/8JxARGzAoGzBgQFJfToLj3snd3Z3Dvoqf/CGKf6a6uU9/YisViccELDwULwA7gFuAMeOEMBIcgU4ApwBRgCjAFXlgBxiBjkDHIGGQMvjAE+M8QY5AxyBhkDDIGGYMvrIBsDM5mM9TrdRwOB2i1WoTDYTidzneS1mo1DIdDhEIh+P3+T+V+RM2PHipLgO12i3w+D5PJhGAwiEKhAI1Gg1QqJT5pLBYLlEolnE6nLwnwiJr/UlyWAP1+H61WC7FYDC6X66/nnM9nFItFLJdLXC6XmwCdTgftdht2u118R8LRb5PJJNbrtaSan9rqgx/IEqBSqWA8HgvrUwvodDpEo1HYbDbxuKtAFosF8/n8JgC5IZfLYb/fC/eQQNQa5CKpNf+LAOVyGaPRSJw+bYBOUqVSIZPJCMtTe+j1epAA5JT7DCDhqtWqOHmj0Yh0Og21Wg05NaWIIMsBtNjJZIJ4PC5EoA2ThROJBCjIptOpsPVqtUKz2XwnAAmUzWZBPe/1ekV40pBT88cF6PV64mQjkQjcbvet32kz3W5XWPzPcXXBNQcoG6iFSCiz2Qw5NX9cgGtiGwwG0fsUeEql8mbn64JIjHsHXOcpFAo4HA4MBgNYrVZBj91uJ5z03ZpSNk9zZLUAFaAWaDQaOB6PYtHUDtTz9+NeAJ/Pd7N5IBCAx+MR2bHZbG5O+m7Nr7xbPOQ9QKrqv2mebAf8ps1IWQsLwDdCfCPEN0J8IyQlPZ9lDlOAKcAUYAowBZ4l0aXsgynAFGAKMAWYAlLS81nmMAWYAkwBpgBT4FkSXco+mAKvToE3EUN4nw3vFosAAAAASUVORK5CYII=" style="width: 64px; height: 64px;">
            </a>
            <div class="media-body">
                <div class="pull-left">
                    <h4 class="title">When you're gone</h4>
                    <p class="artist">Avril Lavigne</p>
                </div>
                <div class="pull-right text-right">
                    <p class="album">Goodbye Lullaby</p>
                    <time class="duration">04:12</time>
                </div>
            </div>
        </div>
        <div class="media song-list">
            <a class="pull-left" href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACe0lEQVR4Xu2Y54oqQRSES8WIqIgJxICKCRFB3/8JxARGzAoGzBgQFJfToLj3snd3Z3Dvoqf/CGKf6a6uU9/YisViccELDwULwA7gFuAMeOEMBIcgU4ApwBRgCjAFXlgBxiBjkDHIGGQMvjAE+M8QY5AxyBhkDDIGGYMvrIBsDM5mM9TrdRwOB2i1WoTDYTidzneS1mo1DIdDhEIh+P3+T+V+RM2PHipLgO12i3w+D5PJhGAwiEKhAI1Gg1QqJT5pLBYLlEolnE6nLwnwiJr/UlyWAP1+H61WC7FYDC6X66/nnM9nFItFLJdLXC6XmwCdTgftdht2u118R8LRb5PJJNbrtaSan9rqgx/IEqBSqWA8HgvrUwvodDpEo1HYbDbxuKtAFosF8/n8JgC5IZfLYb/fC/eQQNQa5CKpNf+LAOVyGaPRSJw+bYBOUqVSIZPJCMtTe+j1epAA5JT7DCDhqtWqOHmj0Yh0Og21Wg05NaWIIMsBtNjJZIJ4PC5EoA2ThROJBCjIptOpsPVqtUKz2XwnAAmUzWZBPe/1ekV40pBT88cF6PV64mQjkQjcbvet32kz3W5XWPzPcXXBNQcoG6iFSCiz2Qw5NX9cgGtiGwwG0fsUeEql8mbn64JIjHsHXOcpFAo4HA4MBgNYrVZBj91uJ5z03ZpSNk9zZLUAFaAWaDQaOB6PYtHUDtTz9+NeAJ/Pd7N5IBCAx+MR2bHZbG5O+m7Nr7xbPOQ9QKrqv2mebAf8ps1IWQsLwDdCfCPEN0J8IyQlPZ9lDlOAKcAUYAowBZ4l0aXsgynAFGAKMAWYAlLS81nmMAWYAkwBpgBT4FkSXco+mAKvToE3EUN4nw3vFosAAAAASUVORK5CYII=" style="width: 64px; height: 64px;">
            </a>
            <div class="media-body">
                <div class="pull-left">
                    <h4 class="title">When you're gone</h4>
                    <p class="artist">Avril Lavigne</p>
                </div>
                <div class="pull-right text-right">
                    <p class="album">Goodbye Lullaby</p>
                    <time class="duration">04:12</time>
                </div>
            </div>
        </div>
    </div>
@stop