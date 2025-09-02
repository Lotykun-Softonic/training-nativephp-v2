# CHALLENGE 1: Basic YouTube Reproducer Android or iOS App
The objective of this challenge is to create a simple mobile application that reproduces YouTube videos using the YouTube Data API. 
The app should allow users to search for videos, view video details, and play videos within the app.
The creation of the app is completely free, however it must meet these minimum characteristics:
At least 5 different screens must be displayed
* Home screen with links to the different functionalities
* YouTube API configuration screen
* Kodi API configuration screen
* Screen listing subscribed YouTube channels
* Screen listing videos from a channel

## Home Screen
This screen must be the main entry point of the app, these are the **requirements**:
* The screen should have buttons or links to navigate to:
  * Kodi API Configuration Screen
  * YouTube API Configuration Screen
  * Subscribed Channels List Screen

## Kodi API Configuration Screen
This screen must allow the user to configure the connection to a Kodi instance, these are the **requirements**:
* The screen should have input fields for:
  * Kodi IP address
  * Kodi Port
  * Kodi UserToken

## YouTube API Configuration Screen
This screen must allow the user to configure the connection to the YouTube Data API, these are the **requirements**:
* The screen should have all the mechanism to authenticate with OAuth2 and generate the access token in any request to the YouTube API

## Subscribed Channels List Screen
This screen must display a list of subscribed YouTube channels, these are the **requirements**:
* The screen should show a list of channels to which the user is subscribed
  * Example of listing subscribed channels
    * GET https://www.googleapis.com/youtube/v3/subscriptions?part=snippet&mine=true&key=API_KEY
      * This call returns a list of channels to which the authenticated user is subscribed
* The layout of the channel list is free but must show at least:
  * Channel thumbnail
  * Channel title
* When a channel from the list is tapped, it should navigate to the Channel Video List Screen

## Channel Video List Screen
This screen must display a list of videos from a YouTube channel according to a search, these are the **requirements**:
* The initial state of the screen should show a list of the 10 latest videos uploaded to the channel (since there is no search yet)
  * Example of listing videos by channel
    * GET https://www.googleapis.com/youtube/v3/search?key=API_KEY&channelId=UCxxxxxxx&part=snippet,id&order=date&maxResults=10&type=video
      * This call returns a list of the 10 latest videos uploaded to the channel {channelId}
* The search is just another call to the YouTube API but related to the selected channel {channelId}
  * Example of searching for videos by channel
    * GET https://www.googleapis.com/youtube/v3/search?key=API_KEY&q=TERM_TO_SEARCH&channelId=UCxxxxxxx&part=snippet,id&order=date&maxResults=10&type=video
      * This search returns a list of videos from the channel related to the TERM_TO_SEARCH parameter within the {channelId} channel, giving me the 10 latest videos uploaded
* If the search has no results, a message `No results found` should be displayed
* There should be a clear search button that will reset the screen to its initial state
* The layout of the video list is free but must show at least:
  * Video thumbnail
  * Video title
* The key to this screen is that when a video from the list is tapped, a contextual menu should open with the following options:
  * Play video --> This action will call the corresponding method for playing a YouTube video on the Kodi platform through its API
* There should also be a multiple selection option for videos in the list to send several videos at once to Kodi (A playlist)
  * For this, there should be a checkbox on each video in the list that allows selecting or deselecting the video
  * Additionally, there should be a {Play Playlist} button that, when pressed, sends all selected videos to Kodi

## About Kodi
Kodi is a free and open-source media player software application developed by the XBMC Foundation, a non-profit technology consortium. Kodi is available for multiple operating systems and hardware platforms, with a software 10-foot user interface for use with televisions and remote controls. It allows users to play and view most videos, music, podcasts, and other digital media files from local and network storage media and the internet.

It is important to note that is not necessary to install kodi on the mobile device or in any other location to accomplish this challenge, the app will only connect to an existing Kodi instance through its API.
The application only needs to have the capability to call an external API given by a host and specific endpoints. Valid responses will be provided in the form of snapshots so that the API behavior can be simulated/tested.

## Examples of API calls to Kodi
* All queries should be authenticated with the Kodi UserToken configured in the Kodi API Configuration Screen adding int he header:
```Authorization: Basic KODI_USERTOKEN```
* More info about Kodi API: https://kodi.wiki/view/JSON-RPC_API/v12

### Play a single YouTube video
  * POST http://KODI_IP:KODI_PORT/jsonrpc
  * Body:
    ```json
    {
      "jsonrpc": "2.0",
      "method": "Player.Open",
      "params": {
        "item": {
          "file": "plugin://plugin.video.youtube/?action=play_video&videoid=VIDEO_ID"
        }
      },
      "id": 1
    }
    ```
### Add video to the end of the current Kodi playlist
  * POST http://KODI_IP:KODI_PORT/jsonrpc
  * Body:
    ```json
    {
      "jsonrpc": "2.0",
      "method": "Playlist.Add",
      "params": {
        "playlistid": 1,
        "item": {
          "file": "plugin://plugin.video.youtube/?action=play_video&videoid=VIDEO_ID"
        }
      },
      "id": 1
    }
    ```
### Add video to specific position in the current Kodi playlist
  * POST http://KODI_IP:KODI_PORT/jsonrpc
  * Body:
    ```json
    {
      "jsonrpc": "2.0",
      "method": "Playlist.Insert",
      "params": {
        "playlistid": 1,
        "position": POSITION_INDEX,
        "item": {
          "file": "plugin://plugin.video.youtube/?action=play_video&videoid=VIDEO_ID"
        }
      },
      "id": 1
    }
    ```
### Start playing the Kodi playlist
  * POST http://KODI_IP:KODI_PORT/jsonrpc
  * Body:
    ```json
    {
      "jsonrpc": "2.0",
      "method": "Player.Open",
      "params": {
        "item": {
          "playlistid": 1
        }
      },
      "id": 1
    }
    ```

## Examples of API Responses from Kodi
### Response OK from adding a video to the end of the current Kodi playlist
  ```json
  {
    "id": 1,
    "jsonrpc": "2.0",
    "result": "OK"
  }
  ```
### Response ERROR from adding a video to the end of the current Kodi playlist
  ```json
  {
    "id": 1,
    "jsonrpc": "2.0",
    "error": {
      "code": -32602,
      "message": "Invalid params."
    }
  }
  ```