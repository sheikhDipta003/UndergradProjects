using GameStore.api.Entities;

namespace GameStore.api.Repositories;

public class InMemGamesRepository : IGamesRepository
{
    private readonly List<Game> games = new(){
        new Game(){
            Id = 1,
            Name = "Rope Hero",
            Genre = "Fighting",
            Price = 19.99M,
            ReleaseDate = new DateTime(1991, 2, 1),
            ImageUri = "https://placeholder.co/100"
        },
        new Game(){
            Id = 2,
            Name = "Temple Run",
            Genre = "Adventure",
            Price = 29.99M,
            ReleaseDate = new DateTime(1999, 4, 11),
            ImageUri = "https://placeholder.co/100"
        },
        new Game(){
            Id = 3,
            Name = "Angry Birds",
            Genre = "Shooting",
            Price = 9.99M,
            ReleaseDate = new DateTime(2007, 6, 6),
            ImageUri = "https://placeholder.co/100"
        }
    };

    public async Task<IEnumerable<Game>> GetAllAsync()
    {
        return await Task.FromResult(games);
    }

    public async Task<Game?> GetAsync(int id)
    {
        return await Task.FromResult(games.Find(game => game.Id == id));
    }

    public async Task CreateAsync(Game game)
    {
        game.Id = games.Max(game => game.Id) + 1;
        games.Add(game);

        await Task.CompletedTask;
    }

    public async Task UpdateAsync(Game updatedGame)
    {
        var i = games.FindIndex(game => game.Id == updatedGame.Id);
        games[i] = updatedGame;

        await Task.CompletedTask;
    }

    public async Task DeleteAsync(int id)
    {
        var i = games.FindIndex(game => game.Id == id);
        games.RemoveAt(i);

        await Task.CompletedTask;
    }
}