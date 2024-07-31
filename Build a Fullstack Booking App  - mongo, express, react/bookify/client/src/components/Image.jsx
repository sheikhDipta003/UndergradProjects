/* eslint-disable react/prop-types */
export const Image = ({src,...rest}) => {
    src = src && src.includes('https://')
      ? src
      : 'http://localhost:40000/uploads/'+src;
    return (
      <img {...rest} src={src}/>
    );
  }