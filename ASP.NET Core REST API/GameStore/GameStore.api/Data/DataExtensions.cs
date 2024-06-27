using GameStore.api.Repositories;
using Microsoft.EntityFrameworkCore;

namespace GameStore.api.Data;

public static class DataExtensions
{
    public static async Task InitializeDbAsync(this IServiceProvider serviceProvider)
    {
        using var scope = serviceProvider.CreateScope();
        var dbContext = scope.ServiceProvider.GetRequiredService<GameStoreContext>();
        await dbContext.Database.MigrateAsync();
    }

    public static IServiceCollection AddRepositories(this IServiceCollection services, IConfiguration config)
    {
        var connString = config.GetConnectionString("GameStoreContext"); services.AddSqlServer<GameStoreContext>(connString)
                .AddScoped<IGamesRepository, EntityFrameworkGamesRepository>();
        return services;
    }
}