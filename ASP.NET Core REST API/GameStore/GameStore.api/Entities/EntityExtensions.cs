using GameStore.api.Dtos;

namespace GameStore.api.Entities;

public static class EntityExtensions
{
    // to map a Game object to a GameDto object; so that we can use Dto in our endpoints instead of the Game objects directly
    public static GameDto AsDto(this Game game){
        return new GameDto(
            game.Id,
            game.Name,
            game.Genre,
            game.Price,
            game.ReleaseDate,
            game.ImageUri
        );
    }
}