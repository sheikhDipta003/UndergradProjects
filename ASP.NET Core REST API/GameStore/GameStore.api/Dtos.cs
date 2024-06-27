//Dtos := Data Transfer Objects
using System.ComponentModel.DataAnnotations;

namespace GameStore.api.Dtos;

// for retrieving the data from the REST API
public record GameDto(
    int Id,
    string Name,
    string Genre,
    decimal Price,
    DateTime ReleaseDate,
    string ImageUri
);

// for creating new data to be stored in DB via the REST API
public record CreateGameDto(
    [Required][StringLength(50)] string Name,
    [Required][StringLength(20)] string Genre,
    [Range(1, 100)] decimal Price,
    DateTime ReleaseDate,
    [Url][StringLength(100)] string ImageUri
);

// for updating the data via the REST API, which is the same as CreateGameDto 
// Dto contracts can change any time, even though they are now the same; so to follow the best practice, UpdateGameDto is created separately
public record UpdateGameDto(
    [Required][StringLength(50)] string Name,
    [Required][StringLength(20)] string Genre,
    [Range(1, 100)] decimal Price,
    DateTime ReleaseDate,
    [Url][StringLength(100)] string ImageUri
);