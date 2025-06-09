CREATE TABLE IF NOT EXISTS communities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    cover_image VARCHAR(512) NOT NULL,
    logo VARCHAR(512) NOT NULL,
    community_link VARCHAR(512) NOT NULL,
    is_artist BOOLEAN DEFAULT TRUE,
    is_group BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (name)
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(512) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    profile_picture VARCHAR(512)
);

CREATE TABLE IF NOT EXISTS community_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    community_id INT NOT NULL,
    display_name VARCHAR(255) NOT NULL,
    profile_picture VARCHAR(512),
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (community_id, display_name),
    UNIQUE (user_id, community_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (community_id) REFERENCES communities(id)
);

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    community_id INT NOT NULL,
    author_id INT NOT NULL,
    is_official_post BOOLEAN DEFAULT FALSE,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (community_id) REFERENCES communities(id),
    FOREIGN KEY (author_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS post_likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    liked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (post_id, user_id),
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS user_subscriptions (
    user_id INT NOT NULL,
    community_id INT NOT NULL,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, community_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (community_id) REFERENCES communities(id)
);


INSERT INTO communities (name, cover_image, logo, community_link, is_artist, is_group) VALUES
('BTS', 'https://phinf.wevpstatic.net/MjAyMzA2MDlfMjA5/MDAxNjg2MjgyOTI4MjM4.uzwN0D1RUzZ7zjv451iLx3k58NbU5tuNGQcNriaLGMog.8BqToW1rnUi10zbpxcvjow74zOJ8mUCJ49z2yGQVaEMg.PNG/8799005373953432ff510aa1-b04b-40f8-8b6d-1e7883e7a481.png?type=f416_354', 'https://phinf.wevpstatic.net/MjAyMzA1MzBfMTkg/MDAxNjg1NDU3ODk5MDE0.FKKdn9RYRUJ25lqMga8pdd42p1Pb335WN9Rgr47uqVcg.LbmfkK-VlDQRN0rKZjuHZuzPZxX78tQr4PvCCef0CGog.JPEG/f6902dd4-b005-466b-921b-5d51aeff4ab5.jpeg?type=s86', 'communityFeed_bts.php', TRUE, TRUE),

('TXT', 'https://phinf.wevpstatic.net/MjAyNTA0MjFfMjcx/MDAxNzQ1MjQ3MTgxMzc0.HrArMo-L8Bc8MntRbMgnzzIEimtwcOBm27PbOtzOboAg.-FQszNeJPhYkX-epYk4UVAZto8DyivKVyMS2n4u4VaYg.JPEG/508f9c7e-9732-4e80-9fd5-575a67b19f3f.jpeg?type=f416_354', 'https://phinf.wevpstatic.net/MjAyNTA0MjFfMTY3/MDAxNzQ1MjQ3MTUzOTMy.CxMqi4YsFF0WpVcJk2F7zvj2NWo1Wwll5ObNUkSJPJQg.h4PueXtrtQRoq9LYpXz9xBvWwkjPDbaTQzIJ7buHFcIg.JPEG/4bd3330c-e1a3-47ff-9cb3-4328da733ea6.jpeg?type=s86', 'communityFeed_txt.php', TRUE, TRUE),

('Weverse zone', 'https://phinf.wevpstatic.net/MjAyNDEwMjhfMjk5/MDAxNzMwMDgxNjM3OTg0.rMCHOqCQBfkGB8jVTmHQreKlVxIlMXjEHkFxwaKufPIg.yh3ytGof7aYJGn1XoIS7UJRQEQ-R0Io3MdEgx1Cf_w0g.PNG/661845219449205085a3bf7a8-66b1-4fe4-91e8-3aa5ce2da650.png?type=f416_354', 'https://phinf.wevpstatic.net/MjAyNDEwMjhfMjkz/MDAxNzMwMDgxNjA1NzIw.3X4iTAkoUyXYrXllscGdKjdBu4Rk2mmk_W3oE4meoKMg.uwZ2_zwnvtR4-7sm8yaCS7FjE2X0MbWeSeZNqne3-5og.PNG/531988257435352809a70731f-f527-4788-a759-768402aee238.png?type=s86', 'communityFeed_weversezone.php', FALSE, FALSE),

('ILLIT', 'https://phinf.wevpstatic.net/MjAyNDA5MzBfNzMg/MDAxNzI3Njg3NTU2MDEw.u_IClM_1tovoWsb8FB3L1BAA_LnDlk8z6b44oeaHO0cg.snAhXfJBtHp2VPsQja2VsZJOiocTVf1Xyt0L3VnErSYg.JPEG/3aa7f1dc-89a2-4106-a835-5dc3ef061006.jpeg?type=f416_354', 'https://phinf.wevpstatic.net/MjAyNDA5MjNfMTc1/MDAxNzI3MDY1MTgwNDAw.27cAeQo-MH-n-DgjCfEQWYli0yjUxQ55mWZH3yl252kg.TQNhAkcm0XRbnv5KJd5pOB6xyGpV4cqAK-Ff8gcJA44g.JPEG/393d4bbd-dad7-4ca1-a3d0-176a7f4d5c65.jpeg?type=s86', 'communityFeed_illit.php', TRUE, TRUE),

('TWS', 'https://phinf.wevpstatic.net/MjAyNDExMTVfMjU5/MDAxNzMxNjc1NzUzMDAw.PASkkyDtQLsNogjkYL1Ez31SQUVxt32KFyP5p_4WExwg.t0xjqNhrrofEhs9UgvOU-2iKRri6-v_r-iRVB3GdjCog.JPEG/72d4b0da-d537-481f-804e-d44fdae55cd6.jpeg?type=f416_354', 'https://phinf.wevpstatic.net/MjAyNDExMDRfMTE1/MDAxNzMwNjQ2MDYxNzU0.NgTOVSKgi2Sumj3h3-CItRjYGIET1qJl_rvBzl6nwfYg.8ys8CsSs-PmqSUcZG5J9pT9U9BbA1jNycMqig8G75usg.JPEG/21a4544e-2d5c-4eb8-a2b4-3366aa0817b3.jpeg?type=s86', 'communityFeed_tws.php', TRUE, TRUE),

('Ariana Grande', 'https://phinf.wevpstatic.net/MjAyNDA3MDlfMjU3/MDAxNzIwNDk4MDE4MTkz.9PTE2h64gJyuAkBp5zZcImnm937xAuqPK5cPLpc3NrEg.PcUuVkHNBqMknlWc-os2Hw5IMwAm_XdyKf2_JrXXYKAg.PNG/1376453103105014864dd86b28-daea-410c-8a1f-93682a459705.png?type=f416_354', 'https://phinf.wevpstatic.net/MjAyNDA3MDlfMjUw/MDAxNzIwNDk4MDc5MTk3.IL21-IkepcYYKNoNYaP0_HEShPNKjGGqAKXI00Uhfl4g.w9ve9vo86edc9Mj-5w7PS2lTO3rQ4pJm9f8RdYx7BFUg.JPEG/43529821843565729a6cace3f-8404-4af3-9691-106a29be7daf.jpg?type=s86', 'communityFeed_arianagrande.php', TRUE, FALSE),

('BOYNEXTDOOR', 'https://phinf.wevpstatic.net/MjAyNTAxMDhfNzIg/MDAxNzM2MzQ0NTA0NjMy.NuXgPBCEuKvznGEKrAyaPgF8WFL_rOeXL46AWmWHjBUg.oDSM5vjIbLm_9TS7xDNJzvWsuBa3x2VAFZ5BzJCkM1Ag.JPEG/c9ee0533-17d8-4a37-8fad-aafbea7c272b.jpeg?type=f416_354', 'https://phinf.wevpstatic.net/MjAyNDEyMTZfMTE2/MDAxNzM0MzUzNzg3MTQx.0KaLcf3-LJH1vt7Ya2L7yFk1cBxtAjokO6pY0OMl8a0g.Wpsw7ZP5D1Fb8LNdMLvv2zqjlmD6VTSrYm7ijXcfyd0g.JPEG/36ab879a-26d7-428f-afd9-c8a8617a3b69.jpeg?type=s86', 'communityFeed_boynextdoor.php', TRUE, TRUE),

('LE SSERAFIM', 'https://phinf.wevpstatic.net/MjAyNTAzMDlfMTk0/MDAxNzQxNTMxODAxMzcx.W8-icjkxTs0cqUwQyNIXiKer0lT0KJya5lyYcT2oHysg.71fAhQq-KPZ13e_jUYuNCXdKPS0w9G4yj8TQ-2jdr-og.PNG/dd84e45c-e3d1-48ae-87cd-366681cee3c8.png?type=f416_354', 'https://phinf.wevpstatic.net/MjAyNTAzMDlfNzcg/MDAxNzQxNTMxNzg4MTMx.IdFDDKNfxq81wjxEuJbXKLX4NSt3tFtN1RycO1yrfscg.SimQKxXoul5dXvpxPWzrkY4y9zgMBCK_cqC-nHOjSAUg.PNG/3c1f1b0b-0f38-4af1-8ecc-66a437ba5fa1.png?type=s86', 'communityFeed_lesserafim.php', TRUE, TRUE),

('BYEON WOO SEOK', 'https://phinf.wevpstatic.net/MjAyNDA1MDhfMjYx/MDAxNzE1MTQ3OTA3Mjk2.D7Jr2QVWPhW3ZAXwowBkrFXtaybgXHKrveIORmqqI2Yg.ZPeeTs6eKlzBvZHKywdY4hGBbUTVX3MtTwWjIFbaEfMg.PNG/97224597453549802bf445054-d353-4227-a22d-4de3c4f783b7.png?type=f416_354', 'https://phinf.wevpstatic.net/MjAyNDA1MDdfMTkw/MDAxNzE1MDc3ODM4Njg0.kmEY8IEJJocA5DugrE0W9YBrFKT84VO8Mf-qH-EAjpcg.S440gXCP1iZiYgepnaIUYr79VLAu__e7TdTvsEYPV1sg.JPEG/97154922849574656dbc37b81-65f8-4283-8dee-2fca94073b0c.jpg?type=s86', 'communityFeed_byeonwooseok.php', FALSE, FALSE),

('Dua Lipa', 'https://phinf.wevpstatic.net/MjAyNDEwMTVfNDQg/MDAxNzI4OTE5Nzk4Nzc3.8Lb0Kq0RkqnhKUiMLuC3_a4l3Ko-UDQBNBzG00aInhMg.VEobf7r9xa2xFg7X0NeCuj7PjC5c_pkWK5ZrlltHUyMg.PNG/4e5f5d72-9710-48d3-999f-64f88c3f5bf5.png?type=f416_354', 'https://phinf.wevpstatic.net/MjAyNDEwMTVfMTYg/MDAxNzI4OTE5Nzk2MjY0.HNrZ-8KjQrCQeMI_njSSSCaY_KsQv5P-90c3VG-9nQ0g.F74LrOeYAwhFrp-iChtwfN2fnApmZgDDW15aKEgIyRAg.JPEG/6eb21730-af1d-44ca-bb4a-72265f682ad3.jpg?type=s86', 'communityFeed_dualipa.php', TRUE, FALSE);